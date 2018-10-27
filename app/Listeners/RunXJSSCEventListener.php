<?php

namespace App\Listeners;

use App\Events\RunXJSSC;
use App\Http\Controllers\Bet\New_Xjssc;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RunXJSSCEventListener
{
    public $XJSSC;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(New_Xjssc $XJSSC)
    {
        $this->XJSSC = $XJSSC;
    }

    /**
     * Handle the event.
     *
     * @param  RunXJSSC  $event
     * @return void
     */
    public function handle(RunXJSSC $event)
    {
        $up = $this->XJSSC->all($event->openCode,$event->openIssue,$event->gameId,$event->id);
        return $up;
    }
}
