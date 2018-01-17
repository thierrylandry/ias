<?php

namespace App\Http\Controllers\Partenaire;

use App\Partenaire;
use App\PieceComptable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DetailsController extends Controller
{
    public function fiche($id)
    {
        $partenaire = Partenaire::find($id);
        $pieces = PieceComptable::with('utilisateur','moyenPaiement')
                    ->where("partenaire_id", $partenaire->id)
                    ->orderBy('creationproforma')
                    ->orderBy('creationfacture')
                    ->get();

        return view('partenaire.fiche', compact("partenaire","pieces"));
    }
}
