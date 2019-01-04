<?php

namespace App\Jobs;

use App\BetHis;
use App\Bets;
use App\Games;
use App\ReportBet;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BetStatementDaily implements ShouldQueue
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
        ini_set('memory_limit','2048M');

        try {
            //获取投注
            if(strtotime($this->aDateTime) >= strtotime(date('Y-m-d',strtotime('-1 day'))))
                $aBet = Bets::getReportBet($this->aDateTime,$this->aDateTime.' 23:59:59');
            else
                $aBet = BetHis::getReportBet($this->aDateTime,$this->aDateTime.' 23:59:59');

            $aArray = [];
            $dateTime = date('Y-m-d H:i:s');

            foreach ($aBet as $iBet){
                $aArray[] = [
                    'game_id' => $iBet->game_id,
                    'user_id' => $iBet->user_id,
                    'bet_money' => $iBet->sumMoney,
                    'bet_count' => $iBet->countBets,
                    'rebate' => 0,
                    'win_bunko' => $iBet->sumWinBunko,
                    'win_count' => $iBet->countWinBunkoBet,
                    'bunko' => $iBet->sumBunko,
                    'date' => $this->aDateTime,
                    'created_at' => $dateTime,
                    'updated_at' => $dateTime,
                ];
            }

            ReportBet::where('date','=',$this->aDateTime)->delete();
            ReportBet::insert($aArray);
        }catch (\Exception $e){
            Log::info($e->getMessage());
        }
    }
}
