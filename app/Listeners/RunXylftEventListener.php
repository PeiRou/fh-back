<?php

namespace App\Listeners;

use App\Events\RunXylft;
use App\Http\Controllers\Bet\New_Xylft;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RunXylftEventListener
{
    public $xylft;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(New_Xylft $xylft)
    {
        $this->xylft = $xylft;
    }

    /**
     * Handle the event.
     *
     * @param  RunMstf  $event
     * @return int
     */
    public function handle(RunXylft $event)
    {
        $up = $this->xylft->all($event->openCode,$event->openIssue,$event->gameId,$event->id,$event->excel);
        return $up;
    }
}
