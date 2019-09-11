<?php

namespace App\Listeners;

use App\Events\RunShfssc;
use App\Http\Controllers\Bet\New_Shfssc;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RunShfsscEventListener
{
    public $shfssc;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(New_Shfssc $shfssc)
    {
        $this->shfssc = $shfssc;
    }

    /**
     * Handle the event.
     *
     * @param  RunShfssc  $event
     * @return int
     */
    public function handle(RunShfssc $event)
    {
        $up = $this->shfssc->all($event->openCode,$event->openIssue,$event->gameId,$event->id,$event->excel);
        return $up;
    }
}
