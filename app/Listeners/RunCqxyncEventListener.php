<?php

namespace App\Listeners;

use App\Events\RunCqxync;
use App\Http\Controllers\Bet\New_Cqxync;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RunCqxyncEventListener
{
    public $CQXYNC;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(New_Cqxync $CQXYNC)
    {
        $this->CQXYNC = $CQXYNC;
    }

    public function handle(RunCqxync $event)
    {
        $up = $this->CQXYNC->all($event->openCode,$event->openIssue,$event->gameId,$event->id);
        return $up;
    }
}
