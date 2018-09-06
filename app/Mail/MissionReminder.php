<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MissionReminder extends Mailable
{
    use Queueable, SerializesModels;

    private $missions;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Collection $missions)
    {
        $this->missions = $missions;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.mission', [ "missions" => $this->missions ])
                    ->subject("Rappel de mission");
    }
}
