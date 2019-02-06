<?php

namespace App\Http\Controllers\Partenaire;

use App\MoyenReglement;
use App\Partenaire;
use App\PieceComptable;
use App\PieceFournisseur;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DetailsController extends Controller
{
    public function ficheClient(int $id)
    {
        $partenaire = Partenaire::find($id);
        $pieces = PieceComptable::with('utilisateur','moyenPaiement')
                    ->where("partenaire_id", $partenaire->id)
                    ->orderBy('creationproforma')
                    ->orderBy('creationfacture')
                    ->get();
        $moyenReglements = MoyenReglement::all();

        return view('partenaire.client', compact("partenaire","pieces", 'moyenReglements'));
    }

    public function ficheFournisseur(int $id)
    {
        $partenaire = Partenaire::find($id);
        $pieces = PieceFournisseur::with('utilisateur','moyenPaiement')
	        ->where("partenaire_id", $partenaire->id)
            ->orderBy('datereglement')
            ->get();

        $moyenReglements = MoyenReglement::all();

        return view('partenaire.fournisseur', compact("partenaire", "pieces", "moyenReglements"));
    }
}
