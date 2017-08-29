<?php
/**
 * Created by PhpStorm.
 * User: BW.KOFFI
 * Date: 06/08/2017
 * Time: 19:48
 */

namespace App\Pdf;


use App\PieceComptable;
use Barryvdh\DomPDF\Facade as PDF;

trait PdfMaker
{
    public function test()
    {
        $invoices = PDF::loadView('pdf.layout')->setPaper('a4','portrait');
        //return $invoices->stream('abc.pdf');
        return view('pdf.layout');
    }

    /**
     * @param $reference
     * @param $state
     */
    public function imprimerPieceComptable($reference, $state)
    {
        $piece = PieceComptable::with('partenaire','lignes','utilisateur.employe')->where("referenceproforma",$reference)->first();

        if($state == PieceComptable::PRO_FORMA)
        {
            $invoices = PDF::loadView('pdf.proforma',compact("piece"))->setPaper('a4','portrait');
            return $invoices->stream("Facture Proforma $reference {$piece->partenaire->raisonsociale}.pdf");
        }

        return back()->withErrors("Aucune pièce comptable à imprimer");
    }
}