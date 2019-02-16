<?php

namespace App\Listeners;

use App\Events\RunWxft;
use App\Http\Controllers\Bet\New_Wxft;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RunWxftEventListener
{
    public $wxft;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(New_Wxft $wxft)
    {
        $this->wxft = $wxft;
    }

    /**
     * Handle the event.
     *
     * @param  RunMstf  $event
     * @return int
     */
    public function handle(RunWxft $event)
    {
        $up = $this->wxft->all($event->openCode,$event->openIssue,$event->gameId,$event->id,$event->excel);
        return $up;
    }
}
