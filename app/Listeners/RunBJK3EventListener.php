<?php

namespace App\Listeners;

use App\Events\RunBJK3;
use App\Http\Controllers\Bet\New_Bjk3;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RunBJK3EventListener
{
    public $BJK3;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(New_Bjk3 $BJK3)
    {
        $this->BJK3 = $BJK3;
    }

    /**
     * Handle the event.
     *
     * @param  RunBJK3  $event
     * @return void
     */
    public function handle(RunBJK3 $event)
    {
        $up = $this->BJK3->all($event->openCode,$event->openIssue,$event->gameId);
        return $up;
    }
}
