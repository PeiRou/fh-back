<?php

namespace App\Listeners;

use App\Events\RunXylsc;
use App\Http\Controllers\Bet\New_Xylsc;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RunXylscEventListener implements ShouldQueue
{
    public $xylsc;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(New_Xylsc $xylsc)
    {
        $this->xylsc = $xylsc;
    }

    /**
     * Handle the event.
     *
     * @param  RunXylsc  $event
     * @return int
     */
    public function handle(RunXylsc $event)
    {
        $up = $this->xylsc->all($event->openCode,$event->openIssue,$event->gameId,$event->id,$event->excel);
        return $up;
    }
}
