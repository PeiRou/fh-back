<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\Event' => [
            'App\Listeners\EventListener',
        ],
        'App\Events\BackPusherEvent' => [
            'App\Listeners\BackPusherEventListener',
        ],
        'App\Events\LotteryFreeze' => [
            'App\Listeners\LotteryFreezeEventListener',
        ],
        'App\Events\LotteryCanceled' => [
            'App\Listeners\LotteryCanceledEventListener',
        ],
        'App\Events\LotteryRenew' => [
            'App\Listeners\LotteryRenewEventListener',
        ],
        'App\Events\LoginEvent' => [
            'App\Listeners\LoginEventListener',
        ],
        'App\Events\BackPusherInsertEvent' => [
            'App\Listeners\BackPusherInsertEventListener',
        ],
    ];
    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
