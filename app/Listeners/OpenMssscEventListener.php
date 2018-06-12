<?php

namespace App\Listeners;

use App\Events\OpenMssscEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Http\Controllers\Bet\MssscController;

class OpenMssscEventListener
{
    protected  $msssc;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(MssscController $msssc)
    {
        $this->msssc = $msssc;
    }

    /**
     * Handle the event.
     *
     * @param  OpenMssscEvent  $event
     * @return void
     */
    public function handle(OpenMssscEvent $event)
    {
        $this->msssc->index($event->openCode,$event->openIssue,$event->gameId,$event->code);
    }
}
