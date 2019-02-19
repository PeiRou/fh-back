<?php

namespace App\Listeners;

use App\Events\RunKsssc;
use App\Http\Controllers\Bet\New_Ksssc;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RunKssscEventListener
{
    public $ksssc;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(New_Ksssc $ksssc)
    {
        $this->ksssc = $ksssc;
    }

    /**
     * Handle the event.
     *
     * @param  RunKsssc  $event
     * @return int
     */
    public function handle(RunKsssc $event)
    {
        $up = $this->ksssc->all($event->openCode,$event->openIssue,$event->gameId,$event->id,$event->excel);
        return $up;
    }
}
