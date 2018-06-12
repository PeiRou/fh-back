<?php

namespace App\Listeners;

use App\Events\RunMsssc;
use App\Http\Controllers\Bet\New_Msssc;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RunMssscEventListener
{
    public $msssc;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(New_Msssc $msssc)
    {
        $this->msssc = $msssc;
    }

    /**
     * Handle the event.
     *
     * @param  RunMsssc  $event
     * @return int
     */
    public function handle(RunMsssc $event)
    {
        $up = $this->msssc->all($event->openCode,$event->openIssue,$event->gameId);
        return $up;
    }
}
