<?php

namespace App\Listeners;

use App\Events\RunWxsc;
use App\Http\Controllers\Bet\New_Wxsc;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RunWxscEventListener implements ShouldQueue
{
    public $wxsc;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(New_Wxsc $wxsc)
    {
        $this->wxsc = $wxsc;
    }

    /**
     * Handle the event.
     *
     * @param  RunWxsc  $event
     * @return int
     */
    public function handle(RunWxsc $event)
    {
        $up = $this->wxsc->all($event->openCode,$event->openIssue,$event->gameId,$event->id,$event->excel);
        return $up;
    }
}
