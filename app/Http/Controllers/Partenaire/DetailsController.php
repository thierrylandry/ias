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
    public function ficheClient(int $id)
    {
        $partenaire = Partenaire::find($id);
        $pieces = PieceComptable::with('utilisateur','moyenPaiement')
                    ->where("partenaire_id", $partenaire->id);

        $this->getPeriode($pieces);

        $pieces = $pieces->orderBy('creationproforma')
                    ->orderBy('creationfacture')
                    ->paginate();

        $moyenReglements = MoyenReglement::all();

        return view('partenaire.client', compact("partenaire","pieces", 'moyenReglements'));
    }

    public function ficheFournisseur(int $id)
    {
        $partenaire = Partenaire::find($id);
        $pieces = PieceFournisseur::with('utilisateur','moyenPaiement')
	        ->where("partenaire_id", $partenaire->id);

        $this->getPeriode($pieces);

	    $pieces = $pieces->orderBy('datereglement')
            ->paginate();

        $moyenReglements = MoyenReglement::all();

        return view('partenaire.fournisseur', compact("partenaire", "pieces", "moyenReglements"));
    }

    private function getPeriode(Builder &$builder)
    {
	    $du = request()->has("debut") ? Carbon::createFromFormat("d/m/Y", request()->query("debut")) : null;
	    $au = request()->has("fin") ? Carbon::createFromFormat("d/m/Y", request()->query("fin")) : null;

	    if($du && $au)
	    {
	    	if($builder->getModel() instanceof PieceComptable){
	    		$builder->whereBetween("creationproforma", [$du->toDateString(), $au->toDateString()])
				    ->orWhereBetween("creationfacture",[$du->toDateString(), $au->toDateString()]);
		    }
	    	if($builder->getModel() instanceof PieceFournisseur){
			    $builder->whereBetween("datepiece", [$du->toDateString(), $au->toDateString()]);
		    }
	    }
    }
}
