<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class BackPusherEvent extends Event implements ShouldBroadcast
{
    use SerializesModels;

    public $type;
    public $title;
    public $info;
    public $users;

    public function __construct($type,$title,$info,$users)
    {
        $this->type = $type;
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
        return ['type' => $this->type, 'title' => $this->title, 'info' => $this->info];
    }
    public function broadcast()
    {
        try{
            parent::broadcast(...func_get_args());
        }catch (\Throwable $e){
            writeLog('error', $e->getMessage());
        }
    }
}
