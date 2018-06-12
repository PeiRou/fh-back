<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class RunPknn
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $openCode;
    public $nn;
    public $openIssue;
    public $gameId;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($openCode,$nn,$openIssue,$gameId)
    {
        $this->openCode  = $openCode;
        $this->nn = $nn;
        $this->openIssue = $openIssue;
        $this->gameId    = $gameId;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
