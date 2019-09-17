<?php

namespace App\Listeners;

use App\Events\RunYflhc;
use App\Http\Controllers\Bet\New_Yflhc;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RunYflhcEventListener
{
    public $yflhc;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(New_Yflhc $yflhc)
    {
        $this->yflhc = $yflhc;
    }

    /**
     * Handle the event.
     *
     * @param  RunYflhc  $event
     * @return int
     */
    public function handle(RunYflhc $event)
    {
        $this->yflhc->all($event->openCode,$event->openIssue,$event->gameId,$event->id,$event->excel);
    }
}
