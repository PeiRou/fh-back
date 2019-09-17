<?php

namespace App\Listeners;

use App\Events\RunWflhc;
use App\Http\Controllers\Bet\New_Wflhc;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RunWflhcEventListener
{
    public $wflhc;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(New_Wflhc $wflhc)
    {
        $this->wflhc = $wflhc;
    }

    /**
     * Handle the event.
     *
     * @param  RunWflhc  $event
     * @return int
     */
    public function handle(RunWflhc $event)
    {
        $this->wflhc->all($event->openCode,$event->openIssue,$event->gameId,$event->id,$event->excel);
    }
}
