<?php

namespace App\Listeners;

use App\Events\RunBjkl8;
use App\Http\Controllers\Bet\New_Bjkl8;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RunBjkl8EventListener
{
    public $bjkl8;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(New_Bjkl8 $bjkl8)
    {
        $this->bjkl8 = $bjkl8;
    }

    /**
     * Handle the event.
     *
     * @param  RunBjkl8  $event
     * @return int
     */
    public function handle(RunBjkl8 $event)
    {
        $up = $this->bjkl8->all($event->openCode,$event->openIssue,$event->gameId);
        return $up;
    }
}
