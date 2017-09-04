<?php

namespace App\Mail;

use App\Application;
use App\Pdf\PdfMaker;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;

class FactureProforma extends Mailable
{
    use Queueable, SerializesModels, PdfMaker;

    private $reference;
    private $typePiece;
    private $objet;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($reference, $typePiece, $objet)
    {
        $this->reference = $reference;
        $this->typePiece = $typePiece;
        $this->objet = $objet;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $from = sprintf("%s<%s, %s>", Auth::user()->employe->nom, Auth::user()->employe->prenoms, Auth::user()->login);

        return $this->from($from)
            ->view('mail.proforma')
            ->subject($this->objet)
            ->attachData($this->imprimerPieceComptable($this->reference, $this->typePiece),
                "Facture proforma ".$this->reference, [
                "mime" => "application/pdf"
            ]);
    }
}
