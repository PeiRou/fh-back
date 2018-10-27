<?php

namespace App\Listeners;

use App\Events\RunGSK3;
use App\Http\Controllers\Bet\New_Gsk3;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RunGSK3EventListener
{
    public $GSK3;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(New_Gsk3 $GSK3)
    {
        $this->GSK3 = $GSK3;
    }

    /**
     * Handle the event.
     *
     * @param  RunGSK3  $event
     * @return void
     */
    public function handle(RunGSK3 $event)
    {
        $up = $this->GSK3->all($event->openCode,$event->openIssue,$event->gameId,$event->id);
        return $up;
    }
}
