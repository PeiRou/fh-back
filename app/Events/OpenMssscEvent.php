<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class OpenMssscEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;


    public $openCode;
    public $openIssue;
    public $gameId;
    public $code;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($openCode,$openIssue,$gameId,$code)
    {
        $this->openCode  = $openCode;
        $this->openIssue = $openIssue;
        $this->gameId    = $gameId;
        $this->code      = $code;
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
