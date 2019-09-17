<?php

namespace App\Listeners;

use App\Events\RunWfssc;
use App\Http\Controllers\Bet\New_Wfssc;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RunWfsscEventListener
{
    public $wfssc;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(New_Wfssc $wfssc)
    {
        $this->wfssc = $wfssc;
    }

    /**
     * Handle the event.
     *
     * @param  RunWfssc  $event
     * @return int
     */
    public function handle(RunWfssc $event)
    {
        $up = $this->wfssc->all($event->openCode,$event->openIssue,$event->gameId,$event->id,$event->excel);
        return $up;
    }
}
