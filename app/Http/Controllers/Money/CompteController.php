<?php

namespace App\Http\Controllers\Money;

use App\Brouillard;
use App\Compte;
use App\LigneCompte;
use App\Metier\Behavior\Notifications;
use App\Utilisateur;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
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

    public function addNewSousCompte(Request $request)
    {
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
        $debut = Carbon::now()->firstOfMonth()->toDateTimeString();
        $fin = Carbon::now()->toDateTimeString();

        $souscompte = $this->getSousCompteFromSlug($slug);

        $last = LigneCompte::where('compte_id','=', $souscompte->id)
                          ->latest('dateaction')->first();

        $solde = $last != null ? $last->balance : 0;

        $lignes = LigneCompte::with('utilisateur')
	                ->where('compte_id','=', $souscompte->id)
	                ->orderBy('dateaction', 'desc');

        $lignes = $this->extracData($lignes, $request, $debut, $fin);

        $lignes = $lignes->paginate(30);

        return view('compte.souscompte', compact("lignes", "solde", "souscompte"));
    }

	/**
	 * @param string $slug
	 * @throws ModelNotFoundException
	 * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model
	 */
    private function getSousCompteFromSlug(string $slug, $lazy = false)
    {
    	 $query = Compte::where('slug','=' ,$slug);

    	 if($lazy === true)
	     {
		     $query = $query->with('lignecompte','utilisateur.employe');
	     }

	    return $query->firstOrFail();
    }

	/**
	 * @param Request $request
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
    public function addNewLine(Request $request){
        $this->validRequest($request);

	    $last = LigneCompte::where('compte_id','=', $request->input("compte_id"))
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

    /**
     * @param Builder $builder
     * @param Request $request
     * @param $du
     * @param $au
     * @return Builder
     */
    private function extracData(Builder $builder, Request $request, &$du, $au)
    {
        if($request->query('objet'))
        {
            $du = Carbon::createFromFormat('d/m/Y', $request->query('debut'))->setTime(0,0,0)->toDateTimeString();
            $au = Carbon::createFromFormat('d/m/Y', $request->query('fin'))->setTime(23,59,59)->toDateTimeString();

            $objet = $request->query('objet');
            $builder->where('objet','like',"%$objet%");
        }

        $builder->whereBetween('dateaction', [$du, $au]);

        return $builder;
    }

    private function validRequest(Request $request){
        $this->validate($request, [
            'dateoperation' => 'required|date_format:d/m/Y',
            'objet' => 'required',
            'montant' => 'required|integer',
            'observation' => 'present',
            'sens' => 'required|in:1,-1',
	        'compte_id' => 'required|exists:compte,id'
        ]);
    }
}
