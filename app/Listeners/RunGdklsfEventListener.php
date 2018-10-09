<?php

namespace App\Listeners;

use App\Events\RunGdklsf;
use App\Http\Controllers\Bet\New_Gdklsf;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RunGdklsfEventListener
{
    public $GDKLSF;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(New_Gdklsf $GDKLSF)
    {
        $this->GDKLSF = $GDKLSF;
    }

    public function handle(RunGdklsf $event)
    {
        $up = $this->GDKLSF->all($event->openCode,$event->openIssue,$event->gameId,$event->id);
        return $up;
    }
}
