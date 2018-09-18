<?php

namespace App\Listeners;

use App\Events\BackPusherEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class BackPusherEventListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  BackPusherEvent  $event
     * @return void
     */
    public function handle(BackPusherEvent $event)
    {
        //
    }
}
