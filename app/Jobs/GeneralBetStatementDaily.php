<?php

namespace App\Jobs;

use App\AgentBackwater;
use App\BetHis;
use App\Bets;
use App\GeneralAgent;
use App\ReportBetGeneral;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class GeneralBetStatementDaily implements ShouldQueue
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
        $aGeneral = GeneralAgent::betGeneralReportData();
        //获取投注
        if(strtotime($this->aDateTime) >= strtotime(date('Y-m-d',strtotime('-1 day'))))
            $aBet = Bets::generalReportData($this->aDateTime,$this->aDateTime.' 23:59:59');
        else
            $aBet = BetHis::generalReportData($this->aDateTime,$this->aDateTime.' 23:59:59');
        //获取返水
        $aBack = AgentBackwater::getBackGroupByGeneralGame($this->aDateTime,$this->aDateTime.' 23:59:59');
        $aArray = [];
        $dateTime = date('Y-m-d H:i:s');
        $time = strtotime($this->aDateTime);
        foreach ($aGeneral as $kGeneral => $iGeneral){
            foreach ($aBet as $kBet => $iBet){
                if($iGeneral->generalId == $iBet->generalId && $this->aDateTime == $iBet->date){
                    $aArray[] = [
                        'general_account' => $iGeneral->generalAccount,
                        'general_name' => $iGeneral->generalName,
                        'general_id' => $iGeneral->generalId,
                        'bet_count' => empty($iBet->idCount)?0:$iBet->idCount,
                        'bet_money' => empty($iBet->betMoneySum)?0.00:$iBet->betMoneySum,
                        'bet_amount' => empty($iBet->sumWinbet)?0.00:$iBet->sumWinbet,
                        'bet_bunko' => empty($iBet->sumBunko)?0.00:$iBet->sumBunko,
                        'fact_bet_bunko' => empty($iBet->sumBunko)?0.00:$iBet->sumBunko,
                        'fact_return_amount' => empty($iBet->back_money)?0.00:$iBet->back_money,
                        'member_count' => empty($iBet->userIdCount)?0:$iBet->userIdCount,
                        'agent_count' => empty($iBet->agentIdCount)?0:$iBet->agentIdCount,
                        'game_id' => $iBet->game_id,
                        'date' => $this->aDateTime,
                        'dateTime' => $time,
                        'created_at' => $dateTime,
                        'updated_at' => $dateTime,
                    ];
                }
            }
        }
        foreach ($aArray as $kArray => $iArray){
            foreach ($aBack as $iBack){
                if($iArray['general_id'] == $iBack->g_id && $iArray['date'] == $iBack->date && $iArray['game_id'] == $iBack->game_id){
                    $aArray[$kArray]['return_amount'] = $iBack->money;
                }
            }
        }
        ReportBetGeneral::where('date','=',$this->aDateTime)->delete();
        foreach ($aArray as $kArray => $iArray){
            if($iArray['bet_count'] > 0)
                GeneralBetStatementInsert::dispatch($iArray)->onQueue($this->setQueueRealName('generalBetStatementInsert'));
        }
    }


    //队列真实名
    public function setQueueRealName($queue){
        return config('prefix')['queue'] . $queue;
    }
}
