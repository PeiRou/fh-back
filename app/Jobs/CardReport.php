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
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($aParam)
    {
        $this->aDateTime = $aParam;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try{
            $repo = new \App\Repository\GamesApi\Card\Report($this->aDateTime);
            $repo->getRes();
            $repo->createData();
            $repo->insertData();
        }catch (\Exception $e){
            \Log::info(print_r($e->getPrevious(), 1));
            echo 'error:'.$this->aDateTime;
        }

    }
}
