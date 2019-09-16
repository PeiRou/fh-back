<?php

namespace App\Listeners;

use App\Events\RunYfsc;
use App\Http\Controllers\Bet\New_Yfsc;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RunYfscEventListener
{
    public $yfsc;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(New_Yfsc $yfsc)
    {
        $this->yfsc = $yfsc;
    }

    /**
     * Handle the event.
     *
     * @param  RunYfsc  $event
     * @return int
     */
    public function handle(RunYfsc $event)
    {
        $up = $this->yfsc->all($event->openCode,$event->openIssue,$event->gameId,$event->id,$event->excel);
        return $up;
    }
}
