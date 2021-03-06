<?php

namespace App\Jobs;

use App\Agent;
use App\Bets;
use App\Capital;
use App\Drawing;
use App\Recharges;
use App\ReportAgent;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

//棋牌投注报表
class CardReport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $aDateTime;

    public function __construct($aParam)
    {
        $this->aDateTime = $aParam;
    }

    public function handle()
    {
        try{
            $repo = new \App\Repository\GamesApi\Card\Report($this->aDateTime);
            $repo->getRes();
            $repo->createData();
            $repo->insertData();
        }catch (\Exception $e){
            writeLog('tcReport', print_r($e->getMessage().$e->getFile().'('.$e->getLine().')', 1));
            writeLog('tcReport', print_r($e->getPrevious(), 1));
            echo 'error:'.$this->aDateTime;
        }

    }
}
