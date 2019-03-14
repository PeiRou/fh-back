<?php

namespace App\Console\Commands;

use App\Jobs\CardReport as jCardReport;
use Illuminate\Console\Command;

class CardReport extends Command
{
    //棋牌报表
    protected $signature = 'CardReport:get {startTime?} {endTime?}';
    protected $description = 'Command description';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        ini_set('memory_limit','2048M');
        $startTime = empty($this->argument('startTime'))?date('Y-m-d',strtotime('-1 day')):$this->argument('startTime');
        $endTime = empty($this->argument('endTime'))?date('Y-m-d',strtotime('-1 day')):$this->argument('endTime');
        $aDate = $this->getSpanDays($startTime,$endTime);
        foreach ($aDate as $kDate => $iDate){
            jCardReport::dispatch($iDate)->onQueue($this->setQueueRealName('CardReport'));
        }
        $this->info('ok');
    }

    public function getSpanDays($startTime,$endTime){
        $aDay = floor((strtotime($endTime) - strtotime($startTime))/24/60/60);
        $aArray = [];
        for($i=0;$i<=$aDay;$i++){
            $aArray[] = date("Y-m-d",strtotime( '+'.$i.' day',strtotime($startTime)));
        }
        return $aArray;
    }

    //队列真实名
    public function setQueueRealName($queue){
        return config('prefix')['queue'] . $queue;
    }
}
