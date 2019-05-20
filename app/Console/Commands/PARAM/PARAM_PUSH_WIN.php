<?php

namespace App\Console\Commands\PARAM;

use App\Events\BackPusherEvent;
use Illuminate\Console\Command;

class PARAM_PUSH_WIN extends Command
{
    protected $signature = 'PARAM_PUSH_WIN {notice?} {userid?}';
    protected $description = '推送中奖通知';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        writeLog('pusher','PARAM_PUSH_WIN:'.$this->argument('notice').'+++'.$this->argument('userid'));
        if(!empty($this->argument('notice')) && !empty($this->argument('userid')))
            event(new BackPusherEvent('win','中奖通知',$this->argument('notice'),array('fnotice-'.$this->argument('userid'))));
        else
            writeLog('pusher','error:'.$this->argument('notice').'+++'.$this->argument('userid'));
    }
}
