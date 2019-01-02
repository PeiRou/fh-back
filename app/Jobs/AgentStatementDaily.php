<?php

namespace App\Jobs;

use App\Agent;
use App\AgentBackwater;
use App\BetHis;
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

class AgentStatementDaily implements ShouldQueue
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
        $aAgent = Agent::betAgentReportData();
        //获取投注
        if(strtotime($this->aDateTime) >= strtotime(date('Y-m-d',strtotime('-1 day'))))
            $aBet = Bets::betAgentReportData($this->aDateTime,$this->aDateTime.' 23:59:59');
        else
            $aBet = BetHis::betAgentReportData($this->aDateTime,$this->aDateTime.' 23:59:59');
        //获取充值金额
        $aRecharges = Recharges::betAgentReportData($this->aDateTime,$this->aDateTime.' 23:59:59');
        //获取提款金额
        $aDrawing = Drawing::betAgentReportData($this->aDateTime,$this->aDateTime.' 23:59:59');
        //获取活动金额
        $aActivity = Capital::betAgentReportData($this->aDateTime,$this->aDateTime.' 23:59:59');
        //获取代理返水金额
        $aBack = AgentBackwater::getBackGroupByAgentId($this->aDateTime,$this->aDateTime.' 23:59:59');
        $aArray = [];
        $dateTime = date('Y-m-d H:i:s');
        $time = strtotime($this->aDateTime);
        foreach ($aAgent as $kAgent => $iAgent){
            $aArray[] = [
                'agent_account' => $iAgent->agentAccount,
                'agent_name' => $iAgent->agentName,
                'agent_id' => $iAgent->agentId,
                'general_account' => $iAgent->generalAccount,
                'general_id' => $iAgent->generalId,
                'general_name' => $iAgent->generalName,
                'date' => $this->aDateTime,
                'dateTime' => $time,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
                'bet_count' => 0,
                'recharges_money' => 0.00,
                'drawing_money' => 0.00,
                'activity_money' => 0.00,
                'return_amount' => 0.00
            ];
        }
        foreach ($aArray as $kArray => $iArray){
            foreach ($aBet as $kBet => $iBet){
                if($iArray['agent_id'] == $iBet->agentId && $iArray['date'] == $iBet->date){
                    $aArray[$kArray]['bet_count'] = empty($iBet->idCount)?0:$iBet->idCount;
                    $aArray[$kArray]['bet_money'] = empty($iBet->betMoneySum)?0.00:$iBet->betMoneySum;
                    $aArray[$kArray]['bet_amount'] = empty($iBet->sumWinbet)?0.00:$iBet->sumWinbet;
                    $aArray[$kArray]['bet_bunko'] = empty($iBet->sumBunko)?0.00:$iBet->sumBunko;
                    $aArray[$kArray]['fact_bet_bunko'] = empty($iBet->sumBunko)?0.00:$iBet->sumBunko;
                    $aArray[$kArray]['fact_return_amount'] = empty($iBet->back_money)?0.00:$iBet->back_money;
                    $aArray[$kArray]['bet_member_count'] = empty($iBet->userIdCount)?0:$iBet->userIdCount;
                }
            }
            foreach ($aRecharges as $kRecharges => $iRecharges){
                if($iArray['agent_id'] == $iRecharges->agentId && $iArray['date'] == $iRecharges->date){
                    $aArray[$kArray]['recharges_money'] = empty($iRecharges->reAmountSum)?0.00:$iRecharges->reAmountSum;
                    $aArray[$kArray]['recharges_member_count'] = empty($iRecharges->userIdCount)?0:$iRecharges->userIdCount;
                }
            }
            foreach ($aDrawing as $kDrawing => $iDrawing){
                if($iArray['agent_id'] == $iDrawing->agentId && $iArray['date'] == $iDrawing->date){
                    $aArray[$kArray]['drawing_money'] = empty($iDrawing->drAmountSum)?0.00:$iDrawing->drAmountSum;
                    $aArray[$kArray]['drawing_member_count'] = empty($iDrawing->userIdCount)?0:$iDrawing->userIdCount;
                }
            }
            foreach ($aActivity as $kActivity => $iActivity){
                if($iArray['agent_id'] == $iActivity->agentId && $iArray['date'] == $iActivity->date){
                    $aArray[$kArray]['activity_money'] = empty($iActivity->sumActivity)?0.00:$iActivity->sumActivity;
                    $aArray[$kArray]['handling_fee'] = empty($iActivity->sumRecharge_fee)?0.00:$iActivity->sumRecharge_fee;
                    $aArray[$kArray]['activity_member_count'] = empty($iActivity->userIdCount)?0:$iActivity->userIdCount;
                }
            }
            foreach ($aBack as $kBack => $iBack){
                if($iArray['agent_id'] == $iBack->agent_id && $iArray['date'] == $iBack->date){
                    $aArray[$kArray]['return_amount'] = empty($iBack->money)?0.00:$iBack->money;
                }
            }
        }
        ReportAgent::where('date','=',$this->aDateTime)->delete();
        foreach ($aArray as $kArray => $iArray){
            if($iArray['bet_count'] > 0 || $iArray['recharges_money'] > 0 || $iArray['drawing_money'] > 0 || $iArray['activity_money'] > 0 || $iArray['return_amount'] > 0)
                AgentStatementInsert::dispatch($iArray)->onQueue($this->setQueueRealName('agentStatementInsert'));
        }
    }


    //队列真实名
    public function setQueueRealName($queue){
        return config('prefix')['queue'] . $queue;
    }
}
