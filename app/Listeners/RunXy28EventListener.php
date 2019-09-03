<?php

namespace App\Listeners;

use App\Events\RunXy28;
use App\Http\Controllers\Bet\New_Xy28;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RunXy28EventListener
{
    public $xy28;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(New_Xy28 $xy28)
    {
        $this->xy28 = $xy28;
    }

    /**
     * Handle the event.
     *
     * @param  RunXy28  $event
     * @return int
     */
    public function handle(RunXy28 $event)
    {
        $up = $this->xy28->all($event->openCode,$event->openIssue,$event->gameId,$event->id);
        return $up;
    }
}
