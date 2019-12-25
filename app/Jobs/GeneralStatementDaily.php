<?php

namespace App\Jobs;

use App\AgentBackwater;
use App\BetHis;
use App\Bets;
use App\Capital;
use App\Drawing;
use App\GeneralAgent;
use App\Recharges;
use App\ReportGeneral;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class GeneralStatementDaily implements ShouldQueue
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
        //获取代理,总代
        $aAgent = GeneralAgent::betGeneralReportData();
        //获取投注
        if(strtotime($this->aDateTime) >= strtotime(date('Y-m-d')))
            $aBet = Bets::betGeneralReportData($this->aDateTime,$this->aDateTime.' 23:59:59');
        else
            $aBet = BetHis::betGeneralReportData($this->aDateTime,$this->aDateTime.' 23:59:59');
        //获取充值金额
        $aRecharges = Recharges::betGeneralReportData($this->aDateTime,$this->aDateTime.' 23:59:59');
        //获取提款金额
        $aDrawing = Drawing::betGeneralReportData($this->aDateTime,$this->aDateTime.' 23:59:59');
        //获取活动金额
        $aActivity = Capital::betGeneralReportData($this->aDateTime,$this->aDateTime.' 23:59:59');
        //获取代理返水
        $aBack = AgentBackwater::getBackGroupByGeneralId($this->aDateTime,$this->aDateTime.' 23:59:59');
        $aArray = [];
        $dateTime = date('Y-m-d H:i:s');
        $time = strtotime($this->aDateTime);
        foreach ($aAgent as $kAgent => $iAgent){
            $aArray[] = [
                'general_account' => $iAgent->generalAccount,
                'general_id' => $iAgent->generalId,
                'general_name' => $iAgent->generalName,
                'date' => $this->aDateTime,
                'dateTime' => $time,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
                'bet_count' => 0,
                'bet_money' => 0,
                'bet_amount' => 0.00,
                'bet_bunko' => 0.00,
                'fact_bet_bunko' => 0.00,
                'fact_return_amount' => 0.00,
                'bet_member_count' => 0,
                'bet_agent_count' => 0,
                'recharges_money' => 0.00,
                'recharges_member_count' => 0,
                'recharges_agent_count' => 0,
                'drawing_money' => 0.00,
                'drawing_member_count' => 0,
                'drawing_agent_count' => 0,
                'activity_money' => 0.00,
                'activity_member_count' => 0,
                'activity_agent_count' => 0,
                'return_amount' => 0.00
            ];
        }
        foreach ($aArray as $kArray => $iArray){
            foreach ($aBet as $kBet => $iBet){
                if($iArray['general_id'] == $iBet->generalId && $iArray['date'] == $iBet->date){
                    $aArray[$kArray]['bet_count'] = empty($iBet->idCount)?0:$iBet->idCount;
                    $aArray[$kArray]['bet_money'] = empty($iBet->betMoneySum)?0.00:$iBet->betMoneySum;
                    $aArray[$kArray]['bet_amount'] = empty($iBet->sumWinbet)?0.00:$iBet->sumWinbet;
                    $aArray[$kArray]['bet_bunko'] = empty($iBet->sumBunko)?0.00:$iBet->sumBunko;
                    $aArray[$kArray]['fact_bet_bunko'] = empty($iBet->sumBunko)?0.00:$iBet->sumBunko;
                    $aArray[$kArray]['fact_return_amount'] = empty($iBet->back_money)?0.00:$iBet->back_money;
                    $aArray[$kArray]['bet_member_count'] = empty($iBet->userIdCount)?0:$iBet->userIdCount;
                    $aArray[$kArray]['bet_agent_count'] = empty($iBet->agentIdCount)?0:$iBet->agentIdCount;
                }
            }
            foreach ($aRecharges as $kRecharges => $iRecharges){
                if($iArray['general_id'] == $iRecharges->generalId && $iArray['date'] == $iRecharges->date){
                    $aArray[$kArray]['recharges_money'] = empty($iRecharges->reAmountSum)?0.00:$iRecharges->reAmountSum;
                    $aArray[$kArray]['recharges_member_count'] = empty($iRecharges->userIdCount)?0:$iRecharges->userIdCount;
                    $aArray[$kArray]['recharges_agent_count'] = empty($iRecharges->agentIdCount)?0:$iRecharges->agentIdCount;
                }
            }
            foreach ($aDrawing as $kDrawing => $iDrawing){
                if($iArray['general_id'] == $iDrawing->generalId && $iArray['date'] == $iDrawing->date){
                    $aArray[$kArray]['drawing_money'] = empty($iDrawing->drAmountSum)?0.00:$iDrawing->drAmountSum;
                    $aArray[$kArray]['drawing_member_count'] = empty($iDrawing->userIdCount)?0:$iDrawing->userIdCount;
                    $aArray[$kArray]['drawing_agent_count'] = empty($iDrawing->agentIdCount)?0:$iDrawing->agentIdCount;
                }
            }
            foreach ($aActivity as $kActivity => $iActivity){
                if($iArray['general_id'] == $iActivity->generalId && $iArray['date'] == $iActivity->date){
                    $aArray[$kArray]['activity_money'] = empty($iActivity->sumActivity)?0.00:$iActivity->sumActivity;
                    $aArray[$kArray]['handling_fee'] = empty($iActivity->sumRecharge_fee)?0.00:$iActivity->sumRecharge_fee;
                    $aArray[$kArray]['activity_member_count'] = empty($iActivity->userIdCount)?0:$iActivity->userIdCount;
                    $aArray[$kArray]['activity_agent_count'] = empty($iActivity->agentIdCount)?0:$iActivity->agentIdCount;
                }
            }
            foreach ($aBack as $iBack){
                if($iArray['general_id'] == $iBack->g_id && $iArray['date'] == $iBack->date){
                    $aArray[$kArray]['return_amount'] = empty($iBack->money)?0.00:$iBack->money;
                }
            }
        }
        ReportGeneral::where('date','=',$this->aDateTime)->delete();
        foreach ($aArray as $kArray => $iArray){
            if($iArray['bet_count'] == 0 && $iArray['recharges_money'] == 0 && $iArray['drawing_money'] == 0 && $iArray['activity_money'] == 0 && $iArray['return_amount'] == 0)
                unset($aArray[$kArray]);
        }
        $aData = array_chunk($aArray,1000);
        foreach ($aData as $iData){
            ReportGeneral::insert($iData);
        }
    }


    //队列真实名
    public function setQueueRealName($queue){
        return config('prefix')['queue'] . $queue;
    }
}
