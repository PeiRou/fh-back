<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class BackPusherInsertEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $param;

    public function __construct($aParam)
    {
        $this->param = $aParam;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
