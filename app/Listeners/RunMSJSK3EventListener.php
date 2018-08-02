<?php

namespace App\Listeners;

use App\Events\RunMSJSK3;
use App\Http\Controllers\Bet\New_Jsk3;
use App\Http\Controllers\Bet\New_Msjsk3;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RunMSJSK3EventListener
{
    public $MSJSK3;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(New_Msjsk3 $MSJSK3)
    {
        $this->MSJSK3 = $MSJSK3;
    }

    /**
     * Handle the event.
     *
     * @param  RunMSJSK3  $event
     * @return void
     */
    public function handle(RunMSJSK3 $event)
    {
        $up = $this->MSJSK3->all($event->openCode,$event->openIssue,$event->gameId);
        return $up;
    }
}
