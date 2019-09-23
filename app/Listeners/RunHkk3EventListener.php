<?php

namespace App\Listeners;

use App\Events\RunHkk3;
use App\Http\Controllers\Bet\New_Hkk3;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RunHkk3EventListener implements ShouldQueue
{
    public $hkk3;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(New_Hkk3 $hkk3)
    {
        $this->hkk3 = $hkk3;
    }

    /**
     * Handle the event.
     *
     * @param  RunMssc  $event
     * @return int
     */
    public function handle(RunHkk3 $event)
    {
        $up = $this->hkk3->all($event->openCode,$event->openIssue,$event->gameId,$event->id,$event->excel);
        return $up;
    }
}
