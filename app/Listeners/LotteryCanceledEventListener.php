<?php

namespace App\Listeners;

use App\Events\LotteryCanceled;
use App\Http\Controllers\Back\OpenHistoryController;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class LotteryCanceledEventListener
{
    public $lottery;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(OpenHistoryController $lottery)
    {
        $this->lottery = $lottery;
    }

    /**
     * Handle the event.
     *
     * @param  Event  $event
     * @return void
     */
    public function handle(LotteryCanceled $event)
    {
        return $this->lottery->canceledBetIssueEvent($event->issue,$event->type);
    }
}
