<?php

namespace App\Listeners;

use App\Events\RunSfssc;
use App\Http\Controllers\Bet\New_Sfssc;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RunSfsscEventListener
{
    public $sfssc;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(New_Sfssc $sfssc)
    {
        $this->sfssc = $sfssc;
    }

    /**
     * Handle the event.
     *
     * @param  RunSfssc  $event
     * @return int
     */
    public function handle(RunSfssc $event)
    {
        $up = $this->sfssc->all($event->openCode,$event->openIssue,$event->gameId,$event->id,$event->excel);
        return $up;
    }
}
