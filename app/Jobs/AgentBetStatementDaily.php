<?php

namespace App\Jobs;

use App\Agent;
use App\Bets;
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
        $aBet = Bets::agentReportData($this->aDateTime,$this->aDateTime.' 23:59:59');
        $aArray = [];
        $dateTime = date('Y-m-d H:i:s');
        $time = strtotime($this->aDateTime);
        foreach ($aAgent as $kAgent => $iAgent){
            foreach ($aBet as $kBet => $iBet){
                if($iAgent->agentId == $iBet->agentId && $this->aDateTime == $iBet->date){
                    $aArray[] = [
                        'agent_account' => $iAgent->agentAccount,
                        'agent_name' => $iAgent->agentName,
                        'agent_id' => $iAgent->agentId,
                        'general_account' => $iAgent->generalAccount,
                        'general_name' => $iAgent->generalName,
                        'general_id' => $iAgent->generalId,
                        'bet_count' => empty($iBet->idCount)?0:$iBet->idCount,
                        'bet_money' => empty($iBet->betMoneySum)?0.00:$iBet->betMoneySum,
                        'bet_amount' => empty($iBet->sumWinbet)?0.00:$iBet->sumWinbet,
                        'bet_bunko' => empty($iBet->sumBunko)?0.00:$iBet->sumBunko,
                        'fact_bet_bunko' => empty($iBet->sumBunko)?0.00:$iBet->sumBunko,
                        'member_count' => empty($iBet->userIdCount)?0:$iBet->userIdCount,
                        'game_id' => $iBet->game_id,
                        'date' => $this->aDateTime,
                        'dateTime' => $time,
                        'created_at' => $dateTime,
                        'updated_at' => $dateTime,
                    ];
                }
            }
        }
        ReportBetAgent::where('date','=',$this->aDateTime)->delete();
        foreach ($aArray as $kArray => $iArray){
            if($iArray['bet_count'] > 0)
                AgentBetStatementInsert::dispatch($iArray)->onQueue($this->setQueueRealName('agentBetStatementInsert'));
        }
    }


    //队列真实名
    public function setQueueRealName($queue){
        return config('prefix')['queue'] . $queue;
    }
}
