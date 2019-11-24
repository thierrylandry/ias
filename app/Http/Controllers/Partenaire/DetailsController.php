<?php

namespace App\Http\Controllers\Partenaire;

use App\MoyenReglement;
use App\Partenaire;
use App\PieceComptable;
use App\PieceFournisseur;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DetailsController extends Controller
{
	use Factures;

    public function ficheClient(int $id)
    {
        $partenaire = Partenaire::find($id);
        $pieces = PieceComptable::with('utilisateur','moyenPaiement')
                    ->where("partenaire_id", $partenaire->id);

        $this->getParameters($pieces);

        $pieces = $pieces->orderBy('creationproforma')
	        ->whereNotNull("referencefacture")
            ->orderBy('creationfacture')
            ->paginate(30);

        $moyenReglements = MoyenReglement::all();

        $status = $this->getStatus();

        return view('partenaire.client', compact("partenaire","pieces", 'moyenReglements', "status"));
    }

    public function ficheFournisseur(int $id)
    {
        $partenaire = Partenaire::find($id);
        $pieces = PieceFournisseur::with('utilisateur','moyenPaiement')
	        ->where("partenaire_id", $partenaire->id);

        $this->getParameters($pieces);

	    $pieces = $pieces->orderBy('datereglement')
            ->paginate(30);

        $moyenReglements = MoyenReglement::all();

	    $status = $this->getStatus();

        return view('partenaire.fournisseur', compact("partenaire", "pieces", "moyenReglements", "status"));
    }
}
