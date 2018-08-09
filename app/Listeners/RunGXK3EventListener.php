<?php

namespace App\Listeners;

use App\Events\RunGXK3;
use App\Http\Controllers\Bet\New_Gxk3;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RunGXK3EventListener
{
    public $GXK3;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(New_Gxk3 $GXK3)
    {
        $this->GXK3 = $GXK3;
    }

    /**
     * Handle the event.
     *
     * @param  RunGXK3  $event
     * @return void
     */
    public function handle(RunGXK3 $event)
    {
        $up = $this->GXK3->all($event->openCode,$event->openIssue,$event->gameId,$event->id);
        return $up;
    }
}
