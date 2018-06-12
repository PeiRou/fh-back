<?php

namespace App\Listeners;

use App\Events\RunPaoma;
use App\Http\Controllers\Bet\New_Paoma;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RunPaomaEventListener
{
    public $paoma;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(New_Paoma $paoma)
    {
        $this->paoma = $paoma;
    }

    /**
     * Handle the event.
     *
     * @param  RunPaoma  $event
     * @return int
     */
    public function handle(RunPaoma $event)
    {
        $up = $this->paoma->all($event->openCode,$event->openIssue,$event->gameId);
        return $up;
    }
}
