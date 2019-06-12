<?php

namespace App\Listeners;

use App\Events\RunXykl8;
use App\Http\Controllers\Bet\New_Xykl8;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RunXykl8EventListener
{
    public $xykl8;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(New_Xykl8 $xykl8)
    {
        $this->xykl8 = $xykl8;
    }

    /**
     * Handle the event.
     *
     * @param  RunXykl8  $event
     * @return int
     */
    public function handle(RunXykl8 $event)
    {
        $up = $this->xykl8->all($event->openCode,$event->openIssue,$event->gameId,$event->id);
        return $up;
    }
}
