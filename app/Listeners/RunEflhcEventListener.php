<?php

namespace App\Listeners;

use App\Events\RunEflhc;
use App\Http\Controllers\Bet\New_Eflhc;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RunEflhcEventListener
{
    public $eflhc;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(New_Eflhc $eflhc)
    {
        $this->eflhc = $eflhc;
    }

    /**
     * Handle the event.
     *
     * @param  RunEflhc  $event
     * @return int
     */
    public function handle(RunEflhc $event)
    {
        $this->eflhc->all($event->openCode,$event->openIssue,$event->gameId,$event->id,$event->excel);
    }
}
