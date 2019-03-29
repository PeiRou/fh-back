<?php

namespace App\Listeners;

use App\Events\RunXyft;
use App\Http\Controllers\Bet\New_Xyft;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RunXyftEventListener
{
    public $xyft;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(New_Xyft $xyft)
    {
        $this->xyft = $xyft;
    }

    /**
     * Handle the event.
     *
     * @param  RunXyft  $event
     * @return int
     */
    public function handle(RunXyft $event)
    {
        $up = $this->xyft->all($event->openCode,$event->openIssue,$event->gameId,$event->id,$event->excel);
        return $up;
    }
}
