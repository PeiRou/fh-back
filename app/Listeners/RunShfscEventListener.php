<?php

namespace App\Listeners;

use App\Events\RunShfsc;
use App\Http\Controllers\Bet\New_Shfsc;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RunShfscEventListener
{
    public $shfsc;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(New_Shfsc $shfsc)
    {
        $this->shfsc = $shfsc;
    }

    /**
     * Handle the event.
     *
     * @param  RunShfsc  $event
     * @return int
     */
    public function handle(RunShfsc $event)
    {
        $up = $this->shfsc->all($event->openCode,$event->openIssue,$event->gameId,$event->id,$event->excel);
        return $up;
    }
}
