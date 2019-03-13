<?php

namespace App\Listeners;

use App\Events\RunSfsc;
use App\Http\Controllers\Bet\New_Sfsc;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RunSfscEventListener
{
    public $sfsc;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(New_Sfsc $sfsc)
    {
        $this->sfsc = $sfsc;
    }

    /**
     * Handle the event.
     *
     * @param  RunSfsc  $event
     * @return int
     */
    public function handle(RunSfsc $event)
    {
        $up = $this->sfsc->all($event->openCode,$event->openIssue,$event->gameId,$event->id,$event->excel);
        return $up;
    }
}
