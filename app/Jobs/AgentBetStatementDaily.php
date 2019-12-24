<?php

namespace App\Jobs;

use App\Agent;
use App\AgentBackwater;
use App\BetHis;
use App\Bets;
use App\Games;
use App\ReportBetAgent;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class AgentBetStatementDaily implements ShouldQueue
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
        if(strtotime($this->aDateTime) >= strtotime(date('Y-m-d')))
            $aBet = Bets::agentReportData($this->aDateTime,$this->aDateTime.' 23:59:59');
        else
            $aBet = BetHis::agentReportData($this->aDateTime,$this->aDateTime.' 23:59:59');
        //获取代理返水
        $aBack = AgentBackwater::getBackGroupByAgentGame($this->aDateTime,$this->aDateTime.' 23:59:59');
        //获取游戏
        $aGame = Games::getGameOption();
        $aArray = [];
        $dateTime = date('Y-m-d H:i:s');
        $time = strtotime($this->aDateTime);
        foreach ($aAgent as $kAgent => $iAgent){
            foreach ($aGame as $iGame) {
                $aArray[] = [
                    'agent_account' => $iAgent->agentAccount,
                    'agent_name' => $iAgent->agentName,
                    'agent_id' => $iAgent->agentId,
                    'general_account' => $iAgent->generalAccount,
                    'general_name' => $iAgent->generalName,
                    'general_id' => $iAgent->generalId,
                    'date' => $this->aDateTime,
                    'dateTime' => $time,
                    'created_at' => $dateTime,
                    'updated_at' => $dateTime,
                    'bet_count' => 0,
                    'return_amount' => 0.00,
                    'game_id' => $iGame->game_id
                ];
            }
        }

        foreach ($aArray as $kArray => $iArray){
            foreach ($aBet as $kBet => $iBet){
                if($iArray['agent_id'] == $iBet->agentId && $iArray['date'] == $iBet->date && $iArray['game_id'] == $iBet->game_id){
                    $aArray[$kArray]['bet_count'] = empty($iBet->idCount)?0:$iBet->idCount;
                    $aArray[$kArray]['bet_money'] = empty($iBet->betMoneySum)?0:$iBet->betMoneySum;
                    $aArray[$kArray]['bet_amount'] = empty($iBet->sumWinbet)?0:$iBet->sumWinbet;
                    $aArray[$kArray]['bet_bunko'] = empty($iBet->sumBunko)?0:$iBet->sumBunko;
                    $aArray[$kArray]['fact_bet_bunko'] = empty($iBet->sumBunko)?0:$iBet->sumBunko;
                    $aArray[$kArray]['fact_return_amount'] = empty($iBet->back_money)?0:$iBet->back_money;
                    $aArray[$kArray]['member_count'] = empty($iBet->userIdCount)?0:$iBet->userIdCount;
                }
            }
            foreach ($aBack as $iBack) {
                if ($iArray['agent_id'] == $iBack->agent_id && $iArray['date'] == $iBack->date && $iArray['game_id'] == $iBack->game_id) {
                    $aArray[$kArray]['return_amount'] = $iBack->money;
                }
            }
        }

        ReportBetAgent::where('date','=',$this->aDateTime)->delete();
        foreach ($aArray as $kArray => $iArray){
            if($iArray['bet_count'] == 0 && $iArray['return_amount'] == 0)  unset($aArray[$kArray]);
        }
        $aData = array_chunk($aArray,1000);
        foreach ($aData as $iData){
            ReportBetAgent::insert($iData);
        }
    }


    //队列真实名
    public function setQueueRealName($queue){
        return config('prefix')['queue'] . $queue;
    }
}
