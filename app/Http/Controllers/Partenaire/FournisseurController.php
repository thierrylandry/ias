<?php

namespace App\Http\Controllers\Partenaire;

use App\Http\Controllers\Controller;
use App\Intervention;
use App\LignePieceFournisseur;
use App\Metier\Behavior\Notifications;
use App\Partenaire;
use App\PieceFournisseur;
use App\Produit;
use App\Statut;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

class FournisseurController extends Controller
{
    use Factures;

    public function newOrder()
    {
	    $commercializables = $this->getCommercializableList();

        $partenaires = Partenaire::where('isfournisseur','=',true)->get();

        return view('partenaire.order.nouvelle', compact('partenaires',"commercializables"));
    }

    public function addOrder(Request $request)
    {
    	//dd($request->input());

        $this->validRequest($request);

        try{
            $pieceFournisseur = new PieceFournisseur($request->except('_token','produits','price','prix','quantity',
	            'produit_id','quantite','modele', 'designation'));
            $pieceFournisseur->datepiece = Carbon::createFromFormat('d/m/Y', $request->input('datepiece'));
            $pieceFournisseur->employe_id = Auth::id();
            $pieceFournisseur->statut = Statut::PIECE_COMPTABLE_FACTURE_AVEC_BL;
            $pieceFournisseur->save();

            $this->saveLines($request, $pieceFournisseur);

        }catch (ModelNotFoundException $e){
            return back()->with('Impossible d\'ajouter cette facture. La référence est déjà utilisée. <br>'.$e->getMessage());
        }

        $notification = new Notifications();
        $notification->add(Notifications::SUCCESS,"Facture fournisseur enregistrée avec succès !");
        return back()->with(Notifications::NOTIFICATION_KEYS_SESSION, $notification);
    }

    private function saveLines(Request $request, PieceFournisseur $piece)
    {
    	for($i=0; $i < count($request->input("produit_id")); $i++)
	    {
	    	$line = new LignePieceFournisseur();
	    	$line->produit_id = $request->input("produit_id")[$i];
	    	$line->prix = $request->input("prix")[$i];
	    	$line->quantite = $request->input("quantite")[$i];
	    	$line->piecefournisseur_id = $piece->id;
	    	$line->modele = $request->input("modele")[$i];
	    	$line->designation = $request->input("designation")[$i];
	    	$line->save();

	    	if($line->modele == Produit::class)
		    {
			    $this->updateStock($line->produit_id, $line->quantite);
		    }
		    if($line->modele == Intervention::class)
		    {
		    	$this->updateIntervention($line->produit_id, $piece);
		    }

	    }
    }

	/**
	 * @param Request $request
	 *
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
    public function liste(Request $request)
    {
	    $pieces = $this->getPiecesFournisseur($request);
	    $statuts = [
		    Statut::PIECE_COMPTABLE_FACTURE_ANNULEE , Statut::PIECE_COMPTABLE_FACTURE_PAYEE ,
		    Statut::PIECE_COMPTABLE_FACTURE_AVEC_BL , Statut::PIECE_COMPTABLE_FACTURE_SANS_BL
	    ];
	    return view("partenaire.order.liste", compact("pieces", "statuts"));
    }

	/**
	 * @param Request $request
	 *
	 * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
	 */
    private function getPiecesFournisseur(Request $request)
    {
	    $raw = PieceFournisseur::with("partenaire","lignes")->paginate(30);

	    return $raw;
    }

    public function details(int $id)
    {
    	$piece = PieceFournisseur::with("lignes","partenaire")->find($id);
    	return view("partenaire.order.details", compact("piece"));
    }
}
