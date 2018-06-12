<?php

namespace App\Listeners;

use App\Events\RunPk10;
use App\Http\Controllers\Bet\New_PK10;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RunPk10EventListener
{
    public $pk10;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(New_PK10 $pk10)
    {
        $this->pk10 = $pk10;
    }

    /**
     * Handle the event.
     *
     * @param  RunPk10  $event
     * @return int
     */
    public function handle(RunPk10 $event)
    {
        $up = $this->pk10->all($event->openCode,$event->openIssue,$event->gameId);
        return $up;
    }
}
