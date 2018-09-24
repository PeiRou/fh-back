<?php

namespace App\Listeners;

use App\Events\RunXYLHC;
use App\Http\Controllers\Bet\New_XYLHC;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RunXYLHCEventListener
{
    public $XYLHC;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(New_XYLHC $XYLHC)
    {
        $this->XYLHC = $XYLHC;
    }

    /**
     * Handle the event.
     *
     * @param  RunXYLHC  $event
     * @return int
     */
    public function handle(RunXYLHC $event)
    {
        $this->XYLHC->all($event->openCode,$event->openIssue,$event->gameId,$event->id,$event->excel);
    }
}
