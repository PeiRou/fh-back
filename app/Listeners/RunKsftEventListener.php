<?php

namespace App\Listeners;

use App\Events\RunKsft;
use App\Http\Controllers\Bet\New_Ksft;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RunKsftEventListener
{
    public $ksft;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(New_Ksft $ksft)
    {
        $this->ksft = $ksft;
    }

    /**
     * Handle the event.
     *
     * @param  RunMstf  $event
     * @return int
     */
    public function handle(RunKsft $event)
    {
        $up = $this->ksft->all($event->openCode,$event->openIssue,$event->gameId,$event->id,$event->excel);
        return $up;
    }
}
