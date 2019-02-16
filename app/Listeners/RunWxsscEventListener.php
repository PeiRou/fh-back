<?php

namespace App\Listeners;

use App\Events\RunWxssc;
use App\Http\Controllers\Bet\New_Wxssc;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RunWxsscEventListener
{
    public $wxssc;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(New_Wxssc $wxssc)
    {
        $this->wxssc = $wxssc;
    }

    /**
     * Handle the event.
     *
     * @param  RunWxssc  $event
     * @return int
     */
    public function handle(RunWxssc $event)
    {
        $up = $this->wxssc->all($event->openCode,$event->openIssue,$event->gameId,$event->id,$event->excel);
        return $up;
    }
}
