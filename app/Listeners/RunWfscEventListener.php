<?php

namespace App\Listeners;

use App\Events\RunWfsc;
use App\Http\Controllers\Bet\New_Wfsc;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RunWfscEventListener
{
    public $wfsc;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(New_Wfsc $wfsc)
    {
        $this->wfsc = $wfsc;
    }

    /**
     * Handle the event.
     *
     * @param  RunWfsc  $event
     * @return int
     */
    public function handle(RunWfsc $event)
    {
        $up = $this->wfsc->all($event->openCode,$event->openIssue,$event->gameId,$event->id,$event->excel);
        return $up;
    }
}
