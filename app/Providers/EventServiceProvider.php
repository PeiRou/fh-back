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
        'App\Events\RunXYLHC' => [
            'App\Listeners\RunXYLHCEventListener',
        ],
        'App\Events\RunJSK3' => [
            'App\Listeners\RunJSK3EventListener',
        ],
        'App\Events\RunAHK3' => [
            'App\Listeners\RunAHK3EventListener',
        ],
        'App\Events\RunGXK3' => [
            'App\Listeners\RunGXK3EventListener',
        ],
        'App\Events\RunHBK3' => [
            'App\Listeners\RunHBK3EventListener',
        ],
        'App\Events\RunHEBEIK3' => [
            'App\Listeners\RunHEBEIK3EventListener',
        ],
        'App\Events\RunGSK3' => [
            'App\Listeners\RunGSK3EventListener',
        ],
        'App\Events\RunGZK3' => [
            'App\Listeners\RunGZK3EventListener',
        ],
        'App\Events\RunXJSSC' => [
            'App\Listeners\RunXJSSCEventListener',
        ],
        'App\Events\RunMSJSK3' => [
            'App\Listeners\RunMSJSK3EventListener',
        ],
        'App\Events\RunQQFFC' => [
            'App\Listeners\RunQQFFCEventListener',
        ],
        'App\Events\OpenMsscEvent' => [
            'App\Listeners\OpenMsscEventListener',
        ],
        'App\Events\OpenMssscEvent' => [
            'App\Listeners\OpenMssscEventListener',
        ],
        'App\Events\RunCqxync' => [
            'App\Listeners\RunCqxyncEventListener',
        ],
        'App\Events\RunGd11x5' => [
            'App\Listeners\RunGd11x5EventListener',
        ],
        'App\Events\RunGdklsf' => [
            'App\Listeners\RunGdklsfEventListener',
        ],
        'App\Events\RunKssc' => [
            'App\Listeners\RunKsscEventListener',
        ],
        'App\Events\RunKsft' => [
            'App\Listeners\RunKsftEventListener',
        ],
        'App\Events\RunKsssc' => [
            'App\Listeners\RunKssscEventListener',
        ],
        'App\Events\RunTwxyft' => [
            'App\Listeners\RunTwxyftEventListener',
        ],
        'App\Events\RunSfsc' => [
            'App\Listeners\RunSfscEventListener',
        ],
        'App\Events\RunSfssc' => [
            'App\Listeners\RunSfsscEventListener',
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
