<?php

namespace App\Http\Controllers\Printer;

use App\Pdf\PdfMaker;
use App\Produit;
use App\Statut;
use App\Vehicule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade as PDF;

class PdfController extends Controller
{
    use PdfMaker;

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
}
