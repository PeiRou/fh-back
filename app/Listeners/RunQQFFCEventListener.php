<?php

namespace App\Listeners;

use App\Events\RunQQFFC;
use App\Http\Controllers\Bet\New_Qqffc;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RunQQFFCEventListener
{
    public $QQFFC;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(New_Qqffc $QQFFC)
    {
        $this->QQFFC = $QQFFC;
    }

    /**
     * Handle the event.
     *
     * @param  RunQQFFC  $event
     * @return void
     */
    public function handle(RunQQFFC $event)
    {
        $up = $this->QQFFC->all($event->openCode,$event->openIssue,$event->gameId,$event->id,$event->excel);
        return $up;
    }
}
