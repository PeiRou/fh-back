<?php

namespace App\Listeners;

use App\Events\RunGZK3;
use App\Http\Controllers\Bet\New_Gzk3;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RunGZK3EventListener
{
    public $GZK3;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(New_Gzk3 $GZK3)
    {
        $this->GZK3 = $GZK3;
    }

    /**
     * Handle the event.
     *
     * @param  RunGZK3  $event
     * @return void
     */
    public function handle(RunGZK3 $event)
    {
        $up = $this->GZK3->all($event->openCode,$event->openIssue,$event->gameId,$event->id);
        return $up;
    }
}
