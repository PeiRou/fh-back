<?php

namespace App\Listeners;

use App\Events\RunYfssc;
use App\Http\Controllers\Bet\New_Yfssc;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RunYfsscEventListener
{
    public $yfssc;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(New_Yfssc $yfssc)
    {
        $this->yfssc = $yfssc;
    }

    /**
     * Handle the event.
     *
     * @param  RunYfssc  $event
     * @return int
     */
    public function handle(RunYfssc $event)
    {
        $up = $this->yfssc->all($event->openCode,$event->openIssue,$event->gameId,$event->id,$event->excel);
        return $up;
    }
}
