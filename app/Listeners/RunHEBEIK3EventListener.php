<?php

namespace App\Listeners;

use App\Events\RunHEBEIK3;
use App\Http\Controllers\Bet\New_Hebeik3;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RunHEBEIK3EventListener
{
    public $HEBEIK3;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(New_Hebeik3 $HEBEIK3)
    {
        $this->HEBEIK3 = $HEBEIK3;
    }

    /**
     * Handle the event.
     *
     * @param  RunHEBEIK3  $event
     * @return void
     */
    public function handle(RunHEBEIK3 $event)
    {
        $up = $this->HEBEIK3->all($event->openCode,$event->openIssue,$event->gameId,$event->id);
        return $up;
    }
}
