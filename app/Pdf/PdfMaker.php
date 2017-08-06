<?php
/**
 * Created by PhpStorm.
 * User: BW.KOFFI
 * Date: 06/08/2017
 * Time: 19:48
 */

namespace App\Pdf;


use Barryvdh\DomPDF\Facade as PDF;

trait PdfMaker
{
    public function test()
    {
        $invoices = PDF::loadView('pdf.layout')->setPaper('a4','portrait');
        //return $invoices->stream('abc.pdf');
        return view('pdf.layout');
    }
}