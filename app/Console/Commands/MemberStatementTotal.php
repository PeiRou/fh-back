<?php

namespace App\Console\Commands;

use App\Jobs\MemberStatementDaily;
use Illuminate\Console\Command;

class MemberStatementTotal extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'MemberReport:TotalSettlement {startTime} {endTime}';

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
        ini_set('memory_limit','2048M');
        $startTime = $this->argument('startTime');
        $endTime = $this->argument('endTime');
        $aDate = $this->getSpanDays($startTime,$endTime);
        foreach ($aDate as $kDate => $iDate){
            MemberStatementDaily::dispatch($iDate)->onQueue($this->setQueueRealName('memberStatementDaily'));
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
