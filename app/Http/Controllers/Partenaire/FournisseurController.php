<?php

namespace App\Http\Controllers\Partenaire;

use App\Http\Controllers\Controller;
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
	    $commercializables = collect(Produit::orderBy("libelle")->get());

        $partenaires = Partenaire::where('isfournisseur','=',true)->get();

        return view('partenaire.order.nouvelle', compact('partenaires',"commercializables"));
    }

    public function addOrder(Request $request)
    {
    	//dd($request->input());

        $this->validRequest($request);

        try{
            $pieceFournisseur = new PieceFournisseur($request->except('_token','produits','price','prix','quantity',
	            'produit_id','quantite'));
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
	    	$line->save();

	    	$this->updateStock($line->produit_id, $line->quantite);
	    }
    }

    private function updateStock(int $produit, int $qte)
    {
        $produit = Produit::find($produit);
        if($produit)
        {
        	$produit->stock += $qte;
        	$produit->save();
        }
	}

    protected function validRequest(Request $request){
        $this->validate($request, [
            'datepiece' => 'required|date_format:d/m/Y',
            'objet' => 'required',
            'reference' => 'required',
            'montanttva' => 'required|integer',
            'montantht' => 'required|integer',
            'produit_id' => 'required|array',
            'prix' => 'required|array',
            'quantite' => 'required|array',
            'partenaire_id' => 'required|exists:partenaire,id',
            'observation' => 'present'
        ]);
    }
}
