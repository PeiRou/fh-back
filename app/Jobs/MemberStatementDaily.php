<?php

namespace App\Jobs;

use App\Activity;
use App\Bets;
use App\Drawing;
use App\Recharges;
use App\ReportMember;
use App\Users;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class MemberStatementDaily implements ShouldQueue
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
        $aBet = Bets::betMemberReportData($this->aDateTime,$this->aDateTime.' 23:59:59');
        //获取充值金额
        $aRecharges = Recharges::betMemberReportData($this->aDateTime,$this->aDateTime.' 23:59:59');
        //获取提款金额
        $aDrawing = Drawing::betMemberReportData($this->aDateTime,$this->aDateTime.' 23:59:59');
        //获取活动金额
        $aActivity = Activity::betMemberReportData($this->aDateTime,$this->aDateTime.' 23:59:59');
        $aArray = [];
        $dateTime = date('Y-m-d H:i:s');
        foreach ($aUser as $kUser => $iUser) {
            foreach ($aBet as $kBet => $iBet) {
                if($iUser->userId == $iBet->user_id){
                    $aArray[] = [
                        'game_id' => $iBet->game_id,
                        'user_account' => $iUser->userAccount,
                        'user_name' => $iUser->userName,
                        'user_id' => $iUser->userId,
                        'agent_account' => $iUser->agentAccount,
                        'agent_name' => $iUser->agentName,
                        'agent_id' => $iUser->agentId,
                        'general_account' => $iUser->generalAccount,
                        'general_name' => $iUser->generalName,
                        'general_id' => $iUser->generalId,
                        'bet_count' => $iBet->idCount,
                        'bet_money' => $iBet->betMoneySum,
                        'bet_amount' => $iBet->sumWinbet,
                        'bet_bunko' => $iBet->sumBunko,
                        'fact_bet_bunko' => $iBet->sumBunko,
                        'date' => $this->aDateTime,
                        'created_at' => $dateTime,
                        'updated_at' => $dateTime,
                    ];
                }
            }
        }
        foreach ($aArray as $kArray => $iArray){
            foreach ($aRecharges as $kRecharges => $iRecharges){
                if($iArray['user_id'] == $iRecharges->userId && $iArray['date'] == $iRecharges->date){
                    $aArray[$kArray]['recharges_money'] = $iRecharges->reAmountSum;
                }
            }
            foreach ($aDrawing as $kDrawing => $iDrawing){
                if($iArray['user_id'] == $iDrawing->user_id && $iArray['date'] == $iDrawing->date){
                    $aArray[$kArray]['drawing_money'] = $iDrawing->drAmountSum;
                }
            }
            foreach ($aActivity as $kActivity => $iActivity){
                if($iArray['user_id'] == $iActivity->to_user && $iArray['date'] == $iActivity->date){
                    $aArray[$kArray]['activity_money'] = $iActivity->sumActivity;
                    $aArray[$kArray]['handling_fee'] = $iActivity->sumRecharge_fee;
                }
            }
        }
        ReportMember::where('date','=',$this->aDateTime)->delete();
        foreach ($aArray as $kArray => $iArray){
            MemberStatementInsert::dispatch($iArray)->onQueue($this->setQueueRealName('memberStatementInsert'));
        }
    }

    //队列真实名
    public function setQueueRealName($queue){
        return config('prefix')['queue'] . $queue;
    }
}
