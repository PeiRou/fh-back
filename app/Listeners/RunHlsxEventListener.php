<?php

namespace App\Listeners;

use App\Events\RunHlsx;
use App\Http\Controllers\Bet\New_Hlsx;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RunHlsxEventListener
{
    public $hlsx;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(New_Hlsx $hlsx)
    {
        $this->hlsx = $hlsx;
    }

    /**
     * Handle the event.
     *
     * @param  RunHlsx  $event
     * @return int
     */
    public function handle(RunHlsx $event)
    {
        $up = $this->hlsx->all($event->openCode,$event->openIssue,$event->gameId,$event->id);
        return $up;
    }
}
