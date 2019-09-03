<?php

namespace App\Jobs\Jq;

use App\JqBetHis;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ReportGameBet implements ShouldQueue
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
        //获取投注
        $aBet = JqBetHis::jqReportGameData($this->aDateTime,$this->aDateTime.' 23:59:59');
        $data = [];
        $time = strtotime($this->aDateTime);
        $dateTime = date('Y-m-d H:i:s');
        foreach ($aBet as $k=>$iBet){
            $arr = [
                'game_id' => $iBet->game_id,
                'game_name' => $iBet->game_name,
                'agent_id' => $iBet->agent_id,
                'agent_account' => $iBet->agent_account,
                'agent_name' => $iBet->agent_name,
                'user_id' => $iBet->user_id,
                'user_account' => $iBet->user_account,
                'user_name' => $iBet->user_name,
                'bet_count' => $iBet->bet_count,
                'bet_money' => $iBet->bet_money,
                'bet_bunko' => $iBet->bet_bunko,
                'up_fraction' => 0,
                'down_fraction' => 0,
                'date' => $this->aDateTime,
                'date_time' => $time,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
                'gameCategory' => $iBet->gameCategory,
                'productType' => $iBet->productType ?? '',
                'gameslist_id' => $iBet->gameslist_id
            ];
            $data[] = $arr;
        }
        $aArray = array_chunk($data,1000);

        \App\JqReportBetGame::where('date','=',$this->aDateTime)->delete();
        foreach ($aArray as $iArray){
            \App\JqReportBetGame::insert($iArray);
        }
    }

    //队列真实名
    public function setQueueRealName($queue){
        return config('prefix')['queue'] . $queue;
    }
}
