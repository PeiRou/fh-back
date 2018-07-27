<?php

namespace App\Listeners;

use App\Events\RunHBK3;
use App\Http\Controllers\Bet\New_Hbk3;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RunHBK3EventListener
{
    public $HBK3;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(New_Hbk3 $HBK3)
    {
        $this->HBK3 = $HBK3;
    }

    /**
     * Handle the event.
     *
     * @param  RunHBK3  $event
     * @return void
     */
    public function handle(RunHBK3 $event)
    {
        $up = $this->HBK3->all($event->openCode,$event->openIssue,$event->gameId);
        return $up;
    }
}
