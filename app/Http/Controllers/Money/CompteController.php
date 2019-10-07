<?php

namespace App\Http\Controllers\Money;

use App\Compte;
use App\LigneCompte;
use App\Metier\Behavior\Notifications;
use App\Metier\Security\Actions;
use App\Service;
use App\Utilisateur;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CompteController extends Controller
{
	use Tresorerie;

    public function registre()
    {
        $comptes = $this->getListCompteByUser();

        $utilisateurs = Utilisateur::with('employe')->get();

        return view('compte.registre', compact("comptes", "utilisateurs"));
    }

	/**
	 * @param Request $request
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 * @throws \Illuminate\Auth\Access\AuthorizationException
	 */
    public function addNewSousCompte(Request $request)
    {
	    $this->authorize(Actions::READ, collect([Service::DG, Service::INFORMATIQUE, Service::ADMINISTRATION, Service::COMPTABILITE]));

    	$this->validate($request, [
    		"libelle" => "required",
    		"employe_id" => "required",
    		"commentaire" => "present",
	    ]);

	    $souscompte = new Compte();
		$souscompte->datecreation = Carbon::now()->toDateTimeString();

    	if($this->checkExistUser($request->input('employe_id'))){
    		$souscompte->employe_id = $request->input('employe_id');
	    }

    	$souscompte->libelle = $request->input("libelle");
    	$souscompte->slug = strtolower(str_slug($request->input("libelle"),'-'));
    	$souscompte->commentaire = $request->input("commentaire");
    	$souscompte->save();

	    $notif = new Notifications();
	    $notif->add(Notifications::SUCCESS,"Nouveau sous compte créé avec succès.");

	    return back()->with(Notifications::NOTIFICATION_KEYS_SESSION, $notif);
    }

	/**
	 * @param string $slug
	 * @param Request $request
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
    public function detailsSousCompte(string $slug, Request $request)
    {
	    $debut = null;
	    $fin = null;

        $souscompte = $this->getSousCompteFromSlug($slug);

        $last = LigneCompte::where('compte_id','=', $souscompte->id)
	        ->where("deleted_at", null)
	        ->latest('dateaction')->first();

        $solde = $last != null ? $last->balance : 0;

        $lignes = LigneCompte::with('utilisateur.employe')
	                ->where('compte_id','=', $souscompte->id)
	                ->orderBy('dateaction', 'desc');

        $lignes = $this->extractData($lignes, $request, $debut, $fin);

        $lignes = $lignes->paginate(30);

        return view('compte.souscompte', compact("lignes", "solde", "souscompte"));
    }

	/**
	 * @param string $slug
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 * @throws \Illuminate\Auth\Access\AuthorizationException
	 */
    public function showReset(string  $slug){

	    $this->authorize(Actions::READ, collect([Service::DG, Service::INFORMATIQUE]));

	    $souscompte = $this->getSousCompteFromSlug($slug);

	    $last = LigneCompte::where('compte_id','=', $souscompte->id)
		    ->where("deleted_at", null)
           ->latest('dateaction')->first();

	    $solde = $last != null ? $last->balance : 0;

	    return view("compte.reset", compact("souscompte", "solde"));
    }

	/**
	 * @param string $slug
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 * @throws \Illuminate\Auth\Access\AuthorizationException
	 */
    public function modifier(string $slug){
	    $this->authorize(Actions::READ, collect([Service::DG, Service::INFORMATIQUE, Service::ADMINISTRATION, Service::COMPTABILITE]));

	    $souscompte = $this->getSousCompteFromSlug($slug);
	    $utilisateurs = Utilisateur::with('employe')->get();
	    return view("compte.modifier", compact("souscompte", "utilisateurs"));
    }

    public function updateCompte(string $slug, Request $request){

	    $souscompte = $this->getSousCompteFromSlug($slug);

		$souscompte->libelle = $request->input("libelle");
		$souscompte->slug = strtolower(str_slug($request->input("libelle"),'-'));
		$souscompte->commentaire = $request->input("commentaire");

	    if($this->checkExistUser($request->input('employe_id'))){
		    $souscompte->employe_id = $request->input('employe_id');
	    }

	    $souscompte->save();

	    $notification = new Notifications();
	    $notification->add(Notifications::SUCCESS,"Sous-compte modifié avec succès !");
	    return redirect()->route("compte.registre")->with(Notifications::NOTIFICATION_KEYS_SESSION, $notification);
    }

	/**
	 * @param string $slug
	 * @param Request $request
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 * @throws \Exception
	 */
    public function reset(string $slug, Request $request)
    {
	    $this->authorize(Actions::READ, collect([Service::DG, Service::INFORMATIQUE]));
	    $souscompte = $this->getSousCompteFromSlug($slug);
	    $souscompte->lignecompte()->delete();

	    if($request->has("delete_account")){
	    	$souscompte->delete();
	    }

	    $notification = new Notifications();
	    $notification->add(Notifications::SUCCESS,"Sous-compte remis à zéro !");
	    return redirect()->route("compte.registre")->with(Notifications::NOTIFICATION_KEYS_SESSION, $notification);
    }

	/**
	 * @param Request $request
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
    public function addNewLine(Request $request){
        $this->validRequest($request);

	    $last = LigneCompte::where('compte_id','=', $request->input("compte_id"))
	                       ->where("deleted_at", null)
	                       ->latest('dateaction')->first();

        $line = new LigneCompte($request->except('_token', 'sens', 'montant'));
	    $line->dateoperation = Carbon::createFromFormat('d/m/Y', $request->input('dateoperation'))->toDateString();
	    $line->dateaction = Carbon::now()->toDateTimeString();
	    $line->montant = intval($request->input('sens')) * $request->input('montant');
	    $line->balance = $last != null ? $last->balance + $line->montant : $line->montant ;
	    $line->employe_id = Auth::id();

	    $line->save();

        $notification = new Notifications();
        $notification->add(Notifications::SUCCESS,"Mouvement de compte enregistré avec succès !");
        return back()->with(Notifications::NOTIFICATION_KEYS_SESSION, $notification);
    }

    public function updateLine(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|exists:lignecompte',
            'dateecriture' => 'required|date_format:d/m/Y',
            'objet' => 'required',
        ]);
        try{
            $line = Compte::findOrFail($request->input('id'));
            $line->dateecriture = Carbon::createFromFormat('d/m/Y', $request->input('dateoperation'))->toDateString();
            $line->objet = $request->input('objet');
            $line->saveOrFail();
        }catch (ModelNotFoundException | \Exception $e){
            return back()->withErrors('Ligne de sous-compte introuvable.');
        }

        $notification = new Notifications();
        $notification->add(Notifications::SUCCESS,"Ligne sous-compte modifiée.");
        return back()->with(Notifications::NOTIFICATION_KEYS_SESSION, $notification);
    }


}
