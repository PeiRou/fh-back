<?php

namespace App\Listeners;

use App\Events\RunMsnn;
use App\Http\Controllers\Bet\New_Msnn;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RunMsnnEventListener
{
    public $msnn;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(New_Msnn $msnn)
    {
        $this->msnn = $msnn;
    }

    /**
     * Handle the event.
     *
     * @param  RunMsnn  $event
     * @return int
     */
    public function handle(RunMsnn $event)
    {
        $up = $this->msnn->all($event->openCode,$event->nn,$event->openIssue,$event->gameId);
        return $up;
    }
}
