<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class LoginEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    protected $username;
    protected $userId;
    protected $ip;
    protected $loginTime;
    protected $type;
    protected $loginHost;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($username, $ip, $userId, $loginTime, $type, $loginHost)
    {
        $this->username = $username;
        $this->ip = $ip;
        $this->userId = $userId;
        $this->loginTime = $loginTime;
        $this->type = $type;
        $this->loginHost = $loginHost;
    }

    public function getUser()
    {
        return $this->username;
    }

    public function getUserId()
    {
        return $this->userId;
    }
    
    public function getIp()
    {
        return $this->ip;
    }

    public function getLoginTime()
    {
        return $this->loginTime;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getLoginHost()
    {
        return $this->loginHost;
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
