<?php

namespace App\Jobs\Jq;

use App\JqBet;
use App\JqBetHis;
use App\JqCapital;
use App\JqReportBet;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ReportBet implements ShouldQueue
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
        $aBet = JqBetHis::jqReportData($this->aDateTime,$this->aDateTime.' 23:59:59');
        //获取上下分
        $aCapital = JqCapital::jqReportData($this->aDateTime,$this->aDateTime.' 23:59:59');
        $aArray = [];
        $time = strtotime($this->aDateTime);
        $dateTime = date('Y-m-d H:i:s');
        foreach ($aBet as $iBet){
            $aArray[$iBet->game_id.'|'.$iBet->user_id] = [
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
            ];
        }
        foreach ($aCapital as $iCapital) {
            if(isset($aArray[$iCapital->game_id.'|'.$iCapital->userid]) && array_key_exists($iCapital->game_id.'|'.$iCapital->userid,$aArray)){
                $aArray[$iCapital->game_id.'|'.$iCapital->userid]['up_fraction'] = empty($iCapital->up_amount)?0:$iCapital->up_amount;
                $aArray[$iCapital->game_id.'|'.$iCapital->userid]['down_fraction'] = empty($iCapital->down_amount)?0:$iCapital->down_amount;
            }else{
                $aArray[$iCapital->game_id.'|'.$iCapital->userid] = [
                    'game_id' => $iCapital->game_id,
                    'game_name' => $iCapital->game_name,
                    'agent_id' => $iCapital->agent_id,
                    'agent_account' => $iCapital->agent_account,
                    'agent_name' => $iCapital->agent_name,
                    'user_id' => $iCapital->userid,
                    'user_account' => $iCapital->user_account,
                    'user_name' => $iCapital->user_name,
                    'bet_count' => 0,
                    'bet_money' => 0.00,
                    'bet_bunko' => 0.00,
                    'up_fraction' => $iCapital->up_amount,
                    'down_fraction' => $iCapital->down_amount,
                    'date' => $this->aDateTime,
                    'date_time' => $time,
                    'created_at' => $dateTime,
                    'updated_at' => $dateTime,
                ];
            }
        }
        $aArray = array_chunk($aArray,1000);
        JqReportBet::where('date','=',$this->aDateTime)->delete();
//        var_dump($aArray);die();
        foreach ($aArray as $iArray){
            InsertReportBet::dispatch($iArray)->onQueue($this->setQueueRealName('generalBetStatementInsert'));
        }
    }

    //队列真实名
    public function setQueueRealName($queue){
        return config('prefix')['queue'] . $queue;
    }
}
