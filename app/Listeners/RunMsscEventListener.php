<?php

namespace App\Listeners;

use App\Events\RunMssc;
use App\Http\Controllers\Bet\New_Mssc;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RunMsscEventListener implements ShouldQueue
{
    public $mssc;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(New_Mssc $mssc)
    {
        $this->mssc = $mssc;
    }

    /**
     * Handle the event.
     *
     * @param  RunMssc  $event
     * @return int
     */
    public function handle(RunMssc $event)
    {
        \Log::info('0|listener');
        $up = $this->mssc->all($event->openCode,$event->openIssue,$event->gameId,$event->id,$event->excel);
        return $up;
    }
}
