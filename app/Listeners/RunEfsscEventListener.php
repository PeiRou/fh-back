<?php

namespace App\Listeners;

use App\Events\RunEfssc;
use App\Http\Controllers\Bet\New_Efssc;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RunEfsscEventListener
{
    public $efssc;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(New_Efssc $efssc)
    {
        $this->efssc = $efssc;
    }

    /**
     * Handle the event.
     *
     * @param  RunEfssc  $event
     * @return int
     */
    public function handle(RunEfssc $event)
    {
        $up = $this->efssc->all($event->openCode,$event->openIssue,$event->gameId,$event->id,$event->excel);
        return $up;
    }
}
