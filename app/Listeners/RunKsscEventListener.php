<?php

namespace App\Listeners;

use App\Events\RunKssc;
use App\Http\Controllers\Bet\New_Kssc;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RunKsscEventListener implements ShouldQueue
{
    public $kssc;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(New_Kssc $kssc)
    {
        $this->kssc = $kssc;
    }

    /**
     * Handle the event.
     *
     * @param  RunKssc  $event
     * @return int
     */
    public function handle(RunKssc $event)
    {
        $up = $this->kssc->all($event->openCode,$event->openIssue,$event->gameId,$event->id,$event->excel);
        return $up;
    }
}
