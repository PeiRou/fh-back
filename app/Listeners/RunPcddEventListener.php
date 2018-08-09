<?php

namespace App\Listeners;

use App\Events\RunPcdd;
use App\Http\Controllers\Bet\New_Pcdd;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RunPcddEventListener
{
    public $pcdd;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(New_Pcdd $pcdd)
    {
        $this->pcdd = $pcdd;
    }

    /**
     * Handle the event.
     *
     * @param  RunPcdd  $event
     * @return int
     */
    public function handle(RunPcdd $event)
    {
        $up = $this->pcdd->all($event->openCode,$event->openIssue,$event->gameId,$event->id);
        return $up;
    }
}
