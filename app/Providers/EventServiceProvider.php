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
        'App\Events\RunMssc' => [
            'App\Listeners\RunMsscEventListener',
        ],
        'App\Events\RunPk10' => [
            'App\Listeners\RunPk10EventListener',
        ],
        'App\Events\RunMstf' => [
            'App\Listeners\RunMstfEventListener',
        ],
        'App\Events\RunMsssc' => [
            'App\Listeners\RunMssscEventListener',
        ],
        'App\Events\RunCqssc' => [
            'App\Listeners\RunCqsscEventListener',
        ],
        'App\Events\RunPaoma' => [
            'App\Listeners\RunPaomaEventListener',
        ],
        'App\Events\RunBjkl8' => [
            'App\Listeners\RunBjkl8EventListener',
        ],
        'App\Events\RunPcdd' => [
            'App\Listeners\RunPcddEventListener',
        ],
        'App\Events\RunMsnn' => [
            'App\Listeners\RunMsnnEventListener',
        ],
        'App\Events\RunPknn' => [
            'App\Listeners\RunPknnEventListener',
        ],
        'App\Events\RunLHC' => [
            'App\Listeners\RunLHCEventListener',
        ],
        'App\Events\OpenMsscEvent' => [
            'App\Listeners\OpenMsscEventListener',
        ],
        'App\Events\OpenMssscEvent' => [
            'App\Listeners\OpenMssscEventListener',
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
