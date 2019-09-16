<?php

namespace App\Listeners;

use App\Events\RunShflhc;
use App\Http\Controllers\Bet\New_Shflhc;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RunShflhcEventListener
{
    public $shflhc;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(New_Shflhc $shflhc)
    {
        $this->shflhc = $shflhc;
    }

    /**
     * Handle the event.
     *
     * @param  RunShflhc  $event
     * @return int
     */
    public function handle(RunShflhc $event)
    {
        $this->shflhc->all($event->openCode,$event->openIssue,$event->gameId,$event->id,$event->excel);
    }
}
