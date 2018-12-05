<?php

namespace App\Listeners;

use App\Events\LotteryFreeze;
use App\Http\Controllers\Back\OpenHistoryController;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class LotteryFreezeEventListener
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
    public function handle(LotteryFreeze $event)
    {
        return $this->lottery->freezeEvent($event->issue,$event->type);
    }
}
