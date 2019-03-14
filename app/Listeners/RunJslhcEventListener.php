<?php

namespace App\Listeners;

use App\Events\RunJslhc;
use App\Http\Controllers\Bet\New_Jslhc;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RunJslhcEventListener
{
    public $jslhc;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(New_Jslhc $jslhc)
    {
        $this->jslhc = $jslhc;
    }

    /**
     * Handle the event.
     *
     * @param  RunJslhc  $event
     * @return int
     */
    public function handle(RunJslhc $event)
    {
        $this->jslhc->all($event->openCode,$event->openIssue,$event->gameId,$event->id,$event->excel);
    }
}
