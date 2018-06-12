<?php

namespace App\Listeners;

use App\Events\RunPknn;
use App\Http\Controllers\Bet\New_Pknn;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RunPknnEventListener
{
    public $pknn;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(New_Pknn $pknn)
    {
        $this->pknn = $pknn;
    }

    /**
     * Handle the event.
     *
     * @param  RunPknn  $event
     * @return int
     */
    public function handle(RunPknn $event)
    {
        $up = $this->pknn->all($event->openCode,$event->nn,$event->openIssue,$event->gameId);
        return $up;
    }
}
