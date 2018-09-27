<?php

namespace App\Jobs;

use App\Bets;
use App\ReportBetMember;
use App\Users;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class MemberBetStatementDaily implements ShouldQueue
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
        //获取用户,代理,总代
        $aUser = Users::betMemberReportData();
        //获取投注
        $aBet = Bets::memberReportData($this->aDateTime,$this->aDateTime.' 23:59:59');
        $aArray = [];
        $dateTime = date('Y-m-d H:i:s');
        $time = strtotime($this->aDateTime);
        foreach ($aUser as $kUser => $iUser){
            foreach ($aBet as $kBet => $iBet){
                if($iUser->userId == $iBet->user_id && $this->aDateTime == $iBet->date){
                    $aArray[] = [
                        'user_account' => $iUser->userAccount,
                        'user_name' => $iUser->userName,
                        'user_id' => $iUser->userId,
                        'user_test_flag' => $iUser->userTestFlag,
                        'agent_account' => $iUser->agentAccount,
                        'agent_name' => $iUser->agentName,
                        'agent_id' => $iUser->agentId,
                        'general_account' => $iUser->generalAccount,
                        'general_name' => $iUser->generalName,
                        'general_id' => $iUser->generalId,
                        'bet_count' => empty($iBet->idCount)?0:$iBet->idCount,
                        'bet_money' => empty($iBet->betMoneySum)?0.00:$iBet->betMoneySum,
                        'bet_amount' => empty($iBet->sumWinbet)?0.00:$iBet->sumWinbet,
                        'bet_bunko' => empty($iBet->sumBunko)?0.00:$iBet->sumBunko,
                        'fact_bet_bunko' => empty($iBet->sumBunko)?0.00:$iBet->sumBunko,
                        'game_id' => $iBet->game_id,
                        'date' => $this->aDateTime,
                        'dateTime' => $time,
                        'created_at' => $dateTime,
                        'updated_at' => $dateTime,
                    ];
                }
            }
        }
        ReportBetMember::where('date','=',$this->aDateTime)->delete();
        foreach ($aArray as $kArray => $iArray){
            if($iArray['bet_count'] > 0)
                MemberBetStatementInsert::dispatch($iArray)->onQueue($this->setQueueRealName('memberBetStatementInsert'));
        }
    }

    //队列真实名
    public function setQueueRealName($queue){
        return config('prefix')['queue'] . $queue;
    }
}
