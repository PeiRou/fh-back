<?php

namespace App\Listeners;

use App\Events\RunGd11x5;
use App\Http\Controllers\Bet\New_Gd11x5;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RunGd11x5EventListener
{
    public $GD11X5;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(New_Gd11x5 $GD11X5)
    {
        $this->GD11X5 = $GD11X5;
    }

    public function handle(RunGd11x5 $event)
    {
        $up = $this->GD11X5->all($event->openCode,$event->openIssue,$event->gameId,$event->id);
        return $up;
    }
}
