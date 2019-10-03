<?php

namespace App\Console\Commands;

use App\Jobs\AgentBackwaterThirdDaily;
use Illuminate\Console\Command;

class AgentBackwaterThird extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'AgentOdds:AgentBackwaterThird {startTime?} {endTime?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '代理模式第三方返水';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $startTime = empty($this->argument('startTime'))?date('Y-m-d',strtotime('-1 day')):$this->argument('startTime');
        $endTime = empty($this->argument('endTime'))?date('Y-m-d',strtotime('-1 day')):$this->argument('endTime');
        $aDate = $this->getSpanDays($startTime,$endTime);
        foreach ($aDate as $kDate => $iDate){
            AgentBackwaterThirdDaily::dispatch($iDate)->onQueue($this->setQueueRealName('ZhRebateThirdDaily'));
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
