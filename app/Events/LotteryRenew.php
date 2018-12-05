<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class LotteryRenew
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $issue;

    public $type;

    public $request;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($request,$issue,$type)
    {
        $this->request = $request;
        $this->issue = $issue;
        $this->type = $type;
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
