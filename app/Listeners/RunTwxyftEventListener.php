<?php

namespace App\Listeners;

use App\Events\RunTwxyft;
use App\Http\Controllers\Bet\New_Twxyft;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RunTwxyftEventListener implements ShouldQueue
{
    public $twxyft;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(New_Twxyft $twxyft)
    {
        $this->twxyft = $twxyft;
    }

    /**
     * Handle the event.
     *
     * @param  RunKssc  $event
     * @return int
     */
    public function handle(RunTwxyft $event)
    {
        $up = $this->twxyft->all($event->openCode,$event->openIssue,$event->gameId,$event->id,$event->excel);
        return $up;
    }
}
