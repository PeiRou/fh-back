<?php

namespace App\Listeners;

use App\Events\RunLHC;
use App\Http\Controllers\Bet\New_LHC;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RunLHCEventListener
{
    public $LHC;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(New_LHC $LHC)
    {
        $this->LHC = $LHC;
    }

    /**
     * Handle the event.
     *
     * @param  RunLHC  $event
     * @return int
     */
    public function handle(RunLHC $event)
    {
        $up = $this->LHC->all($event->openCode,$event->openIssue,$event->gameId);
        return $up;
    }
}
