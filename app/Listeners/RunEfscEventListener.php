<?php

namespace App\Listeners;

use App\Events\RunEfsc;
use App\Http\Controllers\Bet\New_Efsc;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RunEfscEventListener
{
    public $efsc;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(New_Efsc $efsc)
    {
        $this->efsc = $efsc;
    }

    /**
     * Handle the event.
     *
     * @param  RunEfsc  $event
     * @return int
     */
    public function handle(RunEfsc $event)
    {
        $up = $this->efsc->all($event->openCode,$event->openIssue,$event->gameId,$event->id,$event->excel);
        return $up;
    }
}
