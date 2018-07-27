<?php

namespace App\Listeners;

use App\Events\RunJSK3;
use App\Http\Controllers\Bet\New_Jsk3;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RunJSK3EventListener
{
    public $JSK3;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(New_Jsk3 $JSK3)
    {
        $this->JSK3 = $JSK3;
    }

    /**
     * Handle the event.
     *
     * @param  RunJSK3  $event
     * @return void
     */
    public function handle(RunJSK3 $event)
    {
        $up = $this->JSK3->all($event->openCode,$event->openIssue,$event->gameId);
        return $up;
    }
}
