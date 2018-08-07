<?php

namespace App\Listeners;

use App\Events\RunAHK3;
use App\Http\Controllers\Bet\New_Ahk3;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RunAHK3EventListener
{
    public $AHK3;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(New_Ahk3 $AHK3)
    {
        $this->AHK3 = $AHK3;
    }

    /**
     * Handle the event.
     *
     * @param  RunAHK3  $event
     * @return void
     */
    public function handle(RunAHK3 $event)
    {
        $up = $this->AHK3->all($event->openCode,$event->openIssue,$event->gameId);
        return $up;
    }
}
