<?php

namespace App\Listeners;

use App\Events\RunTwbg28;
use App\Http\Controllers\Bet\New_Twbg28;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RunTwbg28EventListener
{
    public $twbg28;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(New_Twbg28 $twbg28)
    {
        $this->twbg28 = $twbg28;
    }

    /**
     * Handle the event.
     *
     * @param  RunTwbg28  $event
     * @return int
     */
    public function handle(RunTwbg28 $event)
    {
        $up = $this->twbg28->all($event->openCode,$event->openIssue,$event->gameId,$event->id);
        return $up;
    }
}
