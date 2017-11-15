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
     * @return $this
     */
    public function imprimerPieceComptable($reference, $state)
    {
        switch($state)
        {
            case PieceComptable::PRO_FORMA :
                return $this->imprimerProForma($reference);
                break;

            case PieceComptable::FACTURE :
                return $this->imprimerFacture($reference);
                break;

            default :
                return back()->withErrors("Aucune pièce comptable à imprimer");
        }
    }

    private function imprimerFacture($reference)
    {
        $pieceComptable = PieceComptable::with('partenaire','lignes','utilisateur.employe')->where("referencefacture",$reference)->first();
        $invoices = PDF::loadView('pdf.facture',compact("pieceComptable"))->setPaper('a4','portrait');
        return $invoices->stream("Facture $reference {$pieceComptable->partenaire->raisonsociale}.pdf");
    }

    private function imprimerProForma($reference)
    {
        $pieceComptable = PieceComptable::with('partenaire','lignes','utilisateur.employe')->where("referenceproforma",$reference)->first();
        $invoices = PDF::loadView('pdf.proforma',compact("pieceComptable"))->setPaper('a4','portrait');
        return $invoices->stream("Facture Proforma $reference {$pieceComptable->partenaire->raisonsociale}.pdf");
    }

    private function makePDF(PieceComptable $pieceComptable, $nom)
    {
        $invoices = PDF::loadView('pdf.proforma',compact("pieceComptable"))->setPaper('a4','portrait');
        return $invoices->stream($nom);
    }
}