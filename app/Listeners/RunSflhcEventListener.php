<?php

namespace App\Listeners;

use App\Events\RunSflhc;
use App\Http\Controllers\Bet\New_Sflhc;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RunSflhcEventListener
{
    public $sflhc;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(New_Sflhc $sflhc)
    {
        $this->sflhc = $sflhc;
    }

    /**
     * Handle the event.
     *
     * @param  RunSflhc  $event
     * @return int
     */
    public function handle(RunSflhc $event)
    {
        $this->sflhc->all($event->openCode,$event->openIssue,$event->gameId,$event->id,$event->excel);
    }
}
