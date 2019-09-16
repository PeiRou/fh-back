<?php

namespace App\Console\Commands\Jq;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class ReportGameBet extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'JqReportGameBet:BetTotalSettlement {startTime?} {endTime?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function handle()
    {
        ini_set('memory_limit','2048M');
        $startTime = empty($this->argument('startTime'))?date('Y-m-d',strtotime('-1 day')):$this->argument('startTime');
        $endTime = empty($this->argument('endTime'))?date('Y-m-d',strtotime('-1 day')):$this->argument('endTime');
        $aDate = $this->getSpanDays($startTime,$endTime);
        foreach ($aDate as $kDate => $iDate){
            \App\Jobs\Jq\ReportGameBet::dispatch($iDate)->onQueue($this->setQueueRealName('jqReportBet'));
        }
        # 报表做完生成一下jq_game_issue表
        try{
            Artisan::call('JqGetBetTime:build');
        }catch (\Throwable $e){
            writeLog('ReportGameBet', $e->getMessage().$e->getFile().'('.$e->getLine().')'.$e->getTraceAsString());
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
