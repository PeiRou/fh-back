<?php

namespace App\Jobs;

use App\Bets;
use App\Capital;
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
        $aActivity = Capital::betMemberReportData($this->aDateTime,$this->aDateTime.' 23:59:59');
        $aArray = [];
        $dateTime = date('Y-m-d H:i:s');
        $time = strtotime($this->aDateTime);
        foreach ($aUser as $kUser => $iUser) {
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
                'date' => $this->aDateTime,
                'dateTime' => $time,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
                'bet_count' => 0,
                'recharges_money' => 0.00,
                'drawing_money' => 0.00,
                'activity_money' => 0.00,
            ];
        }
        foreach ($aArray as $kArray => $iArray){
            foreach ($aBet as $kBet => $iBet){
                if($iArray['user_id'] == $iBet->user_id && $iArray['date'] == $iBet->date){
                    $aArray[$kArray]['bet_count'] = empty($iBet->idCount)?0:$iBet->idCount;
                    $aArray[$kArray]['bet_money'] = empty($iBet->betMoneySum)?0.00:$iBet->betMoneySum;
                    $aArray[$kArray]['bet_amount'] = empty($iBet->sumWinbet)?0.00:$iBet->sumWinbet;
                    $aArray[$kArray]['bet_bunko'] = empty($iBet->sumBunko)?0.00:$iBet->sumBunko;
                    $aArray[$kArray]['fact_bet_bunko'] = empty($iBet->sumBunko)?0.00:$iBet->sumBunko;
                }
            }
            foreach ($aRecharges as $kRecharges => $iRecharges){
                if($iArray['user_id'] == $iRecharges->userId && $iArray['date'] == $iRecharges->date){
                    $aArray[$kArray]['recharges_money'] = empty($iRecharges->reAmountSum)?0.00:$iRecharges->reAmountSum;
                }
            }
            foreach ($aDrawing as $kDrawing => $iDrawing){
                if($iArray['user_id'] == $iDrawing->user_id && $iArray['date'] == $iDrawing->date){
                    $aArray[$kArray]['drawing_money'] = empty($iDrawing->drAmountSum)?0.00:$iDrawing->drAmountSum;
                }
            }
            foreach ($aActivity as $kActivity => $iActivity){
                if($iArray['user_id'] == $iActivity->to_user && $iArray['date'] == $iActivity->date){
                    $aArray[$kArray]['activity_money'] = empty($iActivity->sumActivity)?0.00:$iActivity->sumActivity;
                    $aArray[$kArray]['handling_fee'] = empty($iActivity->sumRecharge_fee)?0.00:$iActivity->sumRecharge_fee;
                }
            }
        }
        ReportMember::where('date','=',$this->aDateTime)->delete();
        foreach ($aArray as $kArray => $iArray){
            if($iArray['bet_count'] > 0 || $iArray['recharges_money'] > 0 || $iArray['drawing_money'] > 0 || $iArray['activity_money'] > 0)
                MemberStatementInsert::dispatch($iArray)->onQueue($this->setQueueRealName('memberStatementInsert'));
        }
    }

    //队列真实名
    public function setQueueRealName($queue){
        return config('prefix')['queue'] . $queue;
    }
}
