<?php

namespace App\Http\Controllers\Printer;

use App\Http\Controllers\Money\Tresorerie;
use App\Http\Controllers\Partenaire\Factures;
use App\LigneCompte;
use App\Partenaire;
use App\Pdf\PdfMaker;
use App\PieceComptable;
use App\PieceFournisseur;
use App\Produit;
use App\Statut;
use App\Vehicule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade as PDF;

class PdfController extends Controller
{
    use PdfMaker, Tresorerie, Factures;

    public function imprimerVehicule()
    {
	    $d = date("d_m_Y");
	    $vehicules = Vehicule::with('genre')->where("status", Statut::VEHICULE_ACTIF)->get();

	    $liste = PDF::loadView('pdf.vehicules',compact("vehicules"))->setPaper('a4','portrait');
	    return $liste->stream("Liste des véhicule au $d .pdf");
    }

    public function imprimerInventaire()
    {
    	$d = date("d_m_Y");

	    $produits = Produit::with("famille")->orderBy("reference")->get();

	    $liste = PDF::loadView('pdf.produits',compact("produits"))->setPaper('a4','portrait');
	    return $liste->stream("Inventaire stock au $d .pdf");
    }

    public function imprimerSousCompte(string $slug)
    {
	    $debut = null;
	    $fin = null;

	    $souscompte = $this->getSousCompteFromSlug($slug);

	    $lignes = LigneCompte::with('utilisateur.employe')
	                         ->where('compte_id','=', $souscompte->id)
	                         ->orderBy('dateaction', 'desc');

	    $lignes = $this->extractData($lignes, \request(), $debut, $fin)->get();

	    $liste = PDF::loadView('pdf.souscompte', compact("lignes", "souscompte"))->setPaper('a4','portrait');
	    return $liste->stream("Situation sous-compte {$souscompte->libelle}.pdf");
    }

    public function imprimerPointClient(int $id){
	    $partenaire = Partenaire::find($id);
	    $pieces = PieceComptable::with('utilisateur','moyenPaiement')
	                            ->where("partenaire_id", $partenaire->id);

	    $this->getParameters($pieces);

	    $pieces = $pieces->orderBy('creationproforma')
	                     ->whereNotNull("referencefacture")
	                     ->orderBy('creationfacture')
	                     ->get();

	    $liste = PDF::loadView('pdf.point-client', compact("partenaire","pieces"))->setPaper('a4','portrait');
	    return $liste->stream("Point client {$partenaire->raisonsociale}.pdf");
    }

    public function imprimerBC(string $id){

    	$bc = PieceFournisseur::with("lignes","partenaire","utilisateur.employe")->find($id);;

	    $liste = PDF::loadView('pdf.boncommande', compact("bc"))->setPaper('a4','portrait');
	    return $liste->stream("Bon de commande {$bc->numerobc}.pdf");
    }
}
