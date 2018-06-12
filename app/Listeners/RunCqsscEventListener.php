<?php

namespace App\Listeners;

use App\Events\RunCqssc;
use App\Http\Controllers\Bet\New_Cqssc;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RunCqsscEventListener
{
    public $cqssc;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(New_Cqssc $cqssc)
    {
        $this->cqssc = $cqssc;
    }

    /**
     * Handle the event.
     *
     * @param  RunCqssc  $event
     * @return int
     */
    public function handle(RunCqssc $event)
    {
        $up = $this->cqssc->all($event->openCode,$event->openIssue,$event->gameId);
        return $up;
    }
}
