<?php

namespace App\Listeners;

use App\Events\OpenMsscEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Http\Controllers\Bet\MsscController;

class OpenMsscEventListener
{
    protected  $mssc;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(MsscController $mssc)
    {
        $this->mssc = $mssc;
    }

    /**
     * Handle the event.
     *
     * @param  OpenMsscEvent  $event
     * @return void
     */
    public function handle(OpenMsscEvent $event)
    {
        $this->mssc->index($event->openCode,$event->openIssue,$event->gameId,$event->code);
    }
}
