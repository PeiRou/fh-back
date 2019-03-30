<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

//TC投注报表
class TcReport implements ShouldQueue
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
            $repo = new \App\Repository\GamesApi\Card\TcReport($this->aDateTime);
            $repo->getRes();
            $repo->createData();
            $repo->insertData();
        }catch (\Throwable $e){
            writeLog('tcReport', print_r($e->getMessage().$e->getFile().'('.$e->getLine().')', 1));
            writeLog('tcReport', print_r($e->getTraceAsString(), 1));
            echo 'error:'.$e->getMessage().$this->aDateTime;
        }
    }
}
