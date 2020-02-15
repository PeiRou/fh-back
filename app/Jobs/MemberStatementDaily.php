<?php

namespace App\Jobs;

use App\BalanceIncomeDay;
use App\BetHis;
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
use SameClass\Model\CapitalModel;

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
        if(strtotime($this->aDateTime) >= strtotime(date('Y-m-d')))
            $aBet = Bets::betMemberReportData($this->aDateTime,$this->aDateTime.' 23:59:59');
        else
            $aBet = BetHis::betMemberReportData($this->aDateTime,$this->aDateTime.' 23:59:59');
        //获取充值金额
        $aRecharges = Recharges::betMemberReportData($this->aDateTime,$this->aDateTime.' 23:59:59');
        //获取提款金额
        $aDrawing = Drawing::betMemberReportData($this->aDateTime,$this->aDateTime.' 23:59:59');
        //获取活动金额
        $aActivity = Capital::betMemberReportData($this->aDateTime,$this->aDateTime.' 23:59:59');
        # todo  t31/t32:第三方游戏返点  t33/t34:会员(重新)返佣  t28:推广人佣金
        $capitalOtherTypes = CapitalModel::capitalOtherTypes; //Capital表要算在其它字段金额的类型
        # 资金明细可以取到的 其它金额
        $aCapitalOther = Capital::betMemberReportOtherData($this->aDateTime,$this->aDateTime.' 23:59:59', $capitalOtherTypes);
        # 余额宝盈利  collect
        $balance_income = BalanceIncomeDay::betMemberReportData($this->aDateTime);
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
                'bet_money' => 0.00,
                'bet_amount' => 0.00,
                'bet_bunko' => 0.00,
                'fact_bet_bunko' => 0.00,
                'fact_return_amount' => 0.00,
                'recharges_money' => 0.00,
                'drawing_money' => 0.00,
                'activity_money' => 0.00,
                'handling_fee' => 0.00,
                'other_money' => 0.00,
                'balance_money' => 0.00,
                'cai_money' => 0.00,
                'bonus_amount' => 0.00,
            ];
        }

        foreach ($aArray as $kArray => $iArray){
            foreach ($aRecharges as $kRecharges => $iRecharges){
                if($iArray['user_id'] == $iRecharges->userId && $iArray['agent_id'] == $iRecharges->agent_id && $iArray['date'] == $iRecharges->date){
                    $aArray[$kArray]['recharges_money'] = empty($iRecharges->reAmountSum)?0.00:$iRecharges->reAmountSum;
                    unset($aRecharges[$kRecharges]);
                }
            }
        }

        foreach ($aRecharges as $iRecharges){
            $aArray[] = [
                'user_account' => $iRecharges->userAccount,
                'user_name' => $iRecharges->userName,
                'user_id' => $iRecharges->userId,
                'user_test_flag' => $iRecharges->userTestFlag,
                'agent_account' => $iRecharges->agentAccount,
                'agent_name' => $iRecharges->agentName,
                'agent_id' => $iRecharges->agentId,
                'general_account' => $iRecharges->generalAccount,
                'general_name' => $iRecharges->generalName,
                'general_id' => $iRecharges->generalId,
                'date' => $this->aDateTime,
                'dateTime' => $time,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
                'bet_count' => 0,
                'bet_money' => 0.00,
                'bet_amount' => 0.00,
                'bet_bunko' => 0.00,
                'fact_bet_bunko' => 0.00,
                'fact_return_amount' => 0.00,
                'recharges_money' => empty($iRecharges->reAmountSum)?0.00:$iRecharges->reAmountSum,
                'drawing_money' => 0.00,
                'activity_money' => 0.00,
                'handling_fee' => 0.00,
                'other_money' => 0.00,
                'balance_money' => 0.00,
                'cai_money' => 0.00,
                'bonus_amount' => 0.00,
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
                    $aArray[$kArray]['fact_return_amount'] = empty($iBet->back_money)?0.00:$iBet->back_money;
                    $aArray[$kArray]['bonus_amount'] = empty($iBet->sumBonus)?0.00:$iBet->sumBonus;
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

            //余额宝盈利
            if($balance_income->get($iArray['user_id'])){
                $aArray[$kArray]['balance_money'] += ($balance_income->get($iArray['user_id']) ?? 0.00);
            }
            //资金明细 - 其它
            foreach ($aCapitalOther as $kCapitalOther => $iCapitalOther){
                if($iArray['user_id'] == $iCapitalOther->to_user && $iArray['date'] == $iCapitalOther->date){
                    $aArray[$kArray]['other_money'] += $iCapitalOther->other_money ?? 0;
                    $aArray[$kArray]['cai_money'] += $iCapitalOther->cai_money ?? 0;
                }
            }

        }
        ReportMember::where('date','=',$this->aDateTime)->delete();
        foreach ($aArray as $kArray => $iArray){
            if($iArray['bet_count'] == 0 && $iArray['recharges_money'] == 0 && $iArray['drawing_money'] == 0 && $iArray['activity_money'] == 0 && $iArray['other_money'] == 0 && $iArray['balance_money'] == 0 && $iArray['cai_money'] == 0)
                unset($aArray[$kArray]);
        }
        $aData = array_chunk($aArray,1000);
        foreach ($aData as $iData){
            ReportMember::insert($iData);
        }
    }

    //队列真实名
    public function setQueueRealName($queue){
        return config('prefix')['queue'] . $queue;
    }
}
