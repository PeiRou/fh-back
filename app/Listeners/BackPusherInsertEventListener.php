<?php

namespace App\Listeners;

use App\Events\BackPusherEvent;
use App\Events\BackPusherInsertEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\DB;

class BackPusherInsertEventListener
{
    public $number = 1000;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Handle the event.
     *
     * @param  BackPusherEvent  $event
     * @return void
     */
    public function handle(BackPusherInsertEvent $event)
    {
        $count = count($event->param);
        $i = 1;
        $aArray = [];
        foreach ($event->param as $key => $value){
            $aArray[] = $value;
            if($key+1 == $this->number*$i || $key+1 == $count){
                DB::table('user_messages')->insert($aArray);
                $aArray = [];
                $i++;
            }
        }

    }
}
