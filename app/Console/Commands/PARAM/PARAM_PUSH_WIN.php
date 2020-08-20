<?php

namespace App\Console\Commands\PARAM;

use App\Events\BackPusherEvent;
use Illuminate\Console\Command;

class PARAM_PUSH_WIN extends Command
{
    protected $signature = 'PARAM_PUSH_WIN {userid?} {type?} {title?} {notice?}';
    protected $description = '推送中奖通知';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        if(!empty($this->argument('userid')) && !empty($this->argument('type')) && !empty($this->argument('title')))
            event(new BackPusherEvent($this->argument('type'),$this->argument('title'),$this->argument('notice'),array('fnotice-'.$this->argument('userid'))));
        else
            writeLog('error','pusher:'.$this->argument('notice').'+++'.$this->argument('userid'));
    }
}
