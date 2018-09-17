<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class BackPusherEvent extends Event implements ShouldBroadcast
{
    use SerializesModels;

    public $title;
    public $info;
    public $users;

    public function __construct($title,$info,$users)
    {
        $this->title = $title;
        $this->info = $info;
        $this->users = $users;
    }

    public function broadcastOn()
    {
        return $this->users;
    }

    public function broadcastAs()
    {
        return 'my-event';
    }

    public function broadcastWith()
    {
        return ['title' => $this->title,'info' => $this->info];
    }
}
