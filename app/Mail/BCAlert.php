<?php

namespace App\Mail;

use App\PieceFournisseur;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class BCAlert extends Mailable
{
    use Queueable, SerializesModels;

	/**
	 * @var PieceFournisseur
	 */
    public $piece;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(PieceFournisseur $fournisseur)
    {
        $this->piece = $fournisseur;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("Validation BC N°".$this->piece->numerobc)
	        ->from(env("MAIL_USERNAME"))
            ->view('mail.bc');
    }
}
