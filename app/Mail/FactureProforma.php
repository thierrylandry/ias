<?php

namespace App\Mail;

use App\Application;
use App\Pdf\PdfMaker;
use App\PieceComptable;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;

class FactureProforma extends Mailable
{
    use Queueable, SerializesModels, PdfMaker;

    private $piece;
    private $typePiece;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(PieceComptable $piece, $typePiece)
    {
        $this->piece = $piece;
        $this->typePiece = $typePiece;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $from = sprintf("%s, %s", Auth::user()->employe->nom, Auth::user()->employe->prenoms);

        $piece = $this->piece;

        //dd(view("mail.proforma", compact("piece"))->render());
        return $this->from($from)
            ->view('mail.proforma', compact("piece"))
            ->subject($this->piece->objet)
            ->attachData($this->imprimerPieceComptable($this->piece->referenceproforma, $this->typePiece),
                "Facture proforma ".$this->piece->referenceproforma.".pdf", [
                "mime" => "application/pdf"
            ]);
    }
}
