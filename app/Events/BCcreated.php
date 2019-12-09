<?php

namespace App\Events;

use App\PieceFournisseur;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class BCcreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

	/**
	 * @var PieceFournisseur
	 */
    public $BC;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(PieceFournisseur $bc)
    {
        $this->BC = $bc;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
