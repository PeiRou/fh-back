<?php

namespace App\Listeners;

use App\Events\RunXylssc;
use App\Http\Controllers\Bet\New_Xylssc;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RunXylsscEventListener
{
    public $xylssc;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(New_Xylssc $xylssc)
    {
        $this->xylssc = $xylssc;
    }

    /**
     * Handle the event.
     *
     * @param  RunXylssc  $event
     * @return int
     */
    public function handle(RunXylssc $event)
    {
        $up = $this->xylssc->all($event->openCode,$event->openIssue,$event->gameId,$event->id,$event->excel);
        return $up;
    }
}
