<?php

namespace App\Listeners;

use App\Events\RunTwbgc;
use App\Http\Controllers\Bet\New_Twbgc;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RunTwbgcEventListener
{
    public $twbgc;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(New_Twbgc $twbgc)
    {
        $this->twbgc = $twbgc;
    }

    /**
     * Handle the event.
     *
     * @param  RunTwbgc  $event
     * @return int
     */
    public function handle(RunTwbgc $event)
    {
        $up = $this->twbgc->all($event->openCode,$event->openIssue,$event->gameId,$event->id);
        return $up;
    }
}
