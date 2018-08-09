<?php

namespace App\Listeners;

use App\Events\RunMstf;
use App\Http\Controllers\Bet\New_Msft;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RunMstfEventListener
{
    public $msft;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(New_Msft $msft)
    {
        $this->msft = $msft;
    }

    /**
     * Handle the event.
     *
     * @param  RunMstf  $event
     * @return int
     */
    public function handle(RunMstf $event)
    {
        $up = $this->msft->all($event->openCode,$event->openIssue,$event->gameId,$event->id,$event->excel);
        return $up;
    }
}
