<?php

namespace App\Jobs;

use App\BalanceIncomeDay;
use App\BetHis;
use App\Bets;
use App\Capital;
use App\ChatHongbaoDt;
use App\Drawing;
use App\GamesList;
use App\JqBetHis;
use App\PromotionRecode;
use App\Recharges;
use App\ThirdRebate;
use App\Users;
use App\ZhReportMember;
use App\ZhReportMemberBunko;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;
use SameClass\Config\GamesListConfig\GamesListConfig;
use SameClass\Model\CapitalModel;

class ZhReportMemberStatementDaily implements ShouldQueue
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
        $aUser = Users::betMemberReportData(false);
        //获取充值金额
        $aRecharges = Recharges::betMemberReportData($this->aDateTime,$this->aDateTime.' 23:59:59');
        //获取提款金额
        $aDrawing = Drawing::betMemberReportData($this->aDateTime,$this->aDateTime.' 23:59:59');
        //获取活动金额和聊天室红包金额
        $aActivity = Capital::betMemberReportData($this->aDateTime,$this->aDateTime.' 23:59:59');
        //聊天室红包金额
        //$aHongBao = ChatHongbaoDt::betMemberReportData($this->aDateTime,$this->aDateTime.' 23:59:59');
//        $aHongBao = Capital::betMemberReportHongBaoData($this->aDateTime,$this->aDateTime.' 23:59:59');
        //获取彩票投注
        if(strtotime($this->aDateTime) >= strtotime(date('Y-m-d')))
            $aBet = Bets::memberReportDataUser($this->aDateTime,$this->aDateTime.' 23:59:59');
        else
            $aBet = BetHis::memberReportDataUser($this->aDateTime,$this->aDateTime.' 23:59:59');

        //获取第三方投注
        $aJqBet = JqBetHis::memberReportDataUser($this->aDateTime,$this->aDateTime.' 23:59:59');
        //棋牌游戏分类字符
        $aGameCategory = GamesList::getCategoryArray();
        //获取游戏名
        $aGameName = GamesList::getNameArray();
        //第三方返水
        $aRebate = ThirdRebate::memberReportData($this->aDateTime,$this->aDateTime.' 23:59:59');
        //会员推广返佣
        $aPromotion = PromotionRecode::memberReportData($this->aDateTime,$this->aDateTime.' 23:59:59');
        # 资金明细可以取到的 其它金额 彩金
        $aCapitalOther = Capital::betMemberReportOtherData($this->aDateTime,$this->aDateTime.' 23:59:59', CapitalModel::capitalOtherTypes);
        # 余额宝盈利  collect
        $balance_income = BalanceIncomeDay::betMemberReportData($this->aDateTime);

        $aArray = [];
        $aArrayBunko = [];
        $dateTime = date('Y-m-d H:i:s');
        $time = strtotime($this->aDateTime);
        foreach ($aUser as $kUser => $iUser) {
            $aArray[] = [
                'user_account' => $iUser->userAccount,
                'user_name' => $iUser->userName,
                'user_id' => $iUser->userId,
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
                'bet_bunko' => 0.00,
                'handling_fee' => 0.00,
                'envelope_money' => 0.00,
                'bet_money' => 0.00,
                'rebate_money' => 0.00,
                'promotion_money' => 0.00,
                'other_money' => 0.00,
                'balance_money' => 0.00,
                'cai_money' => 0.00
            ];
        }

        foreach ($aArray as $kArray => $iArray){
            foreach ($aRecharges as $iRecharges){
                if($iArray['user_id'] == $iRecharges->userId && $iArray['date'] == $iRecharges->date){
                    $aArray[$kArray]['recharges_money'] = empty($iRecharges->reAmountSum)?0.00:$iRecharges->reAmountSum;
                }
            }

            foreach ($aDrawing as $iDrawing){
                if($iArray['user_id'] == $iDrawing->user_id && $iArray['date'] == $iDrawing->date){
                    $aArray[$kArray]['drawing_money'] = empty($iDrawing->drAmountSum)?0.00:$iDrawing->drAmountSum;
                }
            }

            foreach ($aActivity as $iActivity){
                if($iArray['user_id'] == $iActivity->to_user && $iArray['date'] == $iActivity->date){
                    $aArray[$kArray]['activity_money'] = empty($iActivity->sumActivity)?0.00:$iActivity->sumActivity;
                    $aArray[$kArray]['handling_fee'] = empty($iActivity->sumRecharge_fee)?0.00:$iActivity->sumRecharge_fee;
                    $aArray[$kArray]['envelope_money'] = empty($iActivity->sumAmount)?0.00:$iActivity->sumAmount;
                }
            }

//            foreach ($aHongBao as $iHongBao){
//                if($iArray['user_id'] == $iHongBao->users_id && $iArray['date'] == $iHongBao->date){
//                    $aArray[$kArray]['envelope_money'] = empty($iHongBao->amount)?0.00:$iHongBao->amount;
//                }
//            }

            foreach ($aBet as $iBet){
                if($iArray['user_id'] == $iBet->user_id && $iArray['date'] == $iBet->date){
                    $aArray[$kArray]['bet_count'] = empty($iBet->idCount)?0:$iBet->idCount;
                    $aArray[$kArray]['bet_money'] = empty($iBet->betMoneySum)?0:$iBet->betMoneySum;
                    $sumBunko = empty($iBet->sumBunko)?0.00:$iBet->sumBunko;
                    $back_money = empty($iBet->back_money)?0.00:$iBet->back_money;
                    $aArray[$kArray]['bet_bunko'] = round($sumBunko + $back_money,2);
                    $aArrayBunko[] = [
                        'game_id' => 0,
                        'game_name' => '彩票',
                        'user_id' => $iBet->user_id,
                        'user_account' => $iArray['user_account'],
                        'user_name' => $iArray['user_name'],
                        'agent_account' => $iArray['agent_account'],
                        'agent_name' => $iArray['agent_name'],
                        'agent_id' => $iArray['agent_id'],
                        'general_account' => $iArray['general_account'],
                        'general_name' => $iArray['general_name'],
                        'general_id' => $iArray['general_id'],
                        'gameCategory' => 'CP',
                        'bet_bunko' => round($sumBunko + $back_money,2),
                        'bet_money' => empty($iBet->betMoneySum)?0.00:$iBet->betMoneySum,
                        'bet_count' => empty($iBet->idCount)?0:$iBet->idCount,
                        'rebate_money' => 0.00,
                        'promotion_money' => 0.00,
                        'date' => $iBet->date,
                        'dateTime' => $time,
                        'created_at' => $dateTime,
                        'updated_at' => $dateTime,
                    ];
                }
            }

            foreach ($aJqBet as $iJqBet){
                if($iArray['user_id'] == $iJqBet->user_id && !empty($iJqBet->gameslist_id)){
                    $aArray[$kArray]['bet_count'] += empty($iJqBet->bet_count)?0:$iJqBet->bet_count;
                    $aArray[$kArray]['bet_bunko'] += empty($iJqBet->bet_bunko)?0.00:$iJqBet->bet_bunko;
                    $aArray[$kArray]['bet_money'] += empty($iJqBet->bet_money)?0.00:$iJqBet->bet_money;
                    $aArrayBunko[] = [
                        'game_id' => $iJqBet->gameslist_id,
                        'game_name' => (isset($aGameCategory[$iJqBet->gameslist_id])?$aGameCategory[$iJqBet->gameslist_id]:'默认分类').'_'.(isset($aGameName[$iJqBet->gameslist_id])?$aGameName[$iJqBet->gameslist_id]:'默认游戏'),
                        'user_id' => $iJqBet->user_id,
                        'user_account' => $iArray['user_account'],
                        'user_name' => $iArray['user_name'],
                        'agent_account' => $iArray['agent_account'],
                        'agent_name' => $iArray['agent_name'],
                        'agent_id' => $iArray['agent_id'],
                        'general_account' => $iArray['general_account'],
                        'general_name' => $iArray['general_name'],
                        'general_id' => $iArray['general_id'],
                        'gameCategory' => $iJqBet->gameCategory,
                        'bet_bunko' => empty($iJqBet->bet_bunko)?0.00:$iJqBet->bet_bunko,
                        'bet_money' => empty($iJqBet->bet_money)?0.00:$iJqBet->bet_money,
                        'bet_count' => empty($iJqBet->bet_count)?0:$iJqBet->bet_count,
                        'rebate_money' => 0.00,
                        'promotion_money' => 0.00,
                        'date' => $this->aDateTime,
                        'dateTime' => $time,
                        'created_at' => $dateTime,
                        'updated_at' => $dateTime,
                    ];
                }
            }

            foreach ($aRebate as $iRebate){
                if($iArray['user_id'] == $iRebate->user_id){
                    $aArray[$kArray]['rebate_money'] += empty($iRebate->money)?0:$iRebate->money;
                }
            }

            foreach ($aPromotion as $iPromotion){
                if($iArray['user_id'] == $iPromotion->user_id){
                    $aArray[$kArray]['promotion_money'] += empty($iPromotion->money)?0:$iPromotion->money;
                }
            }

            //余额宝盈利
            if($balance_income->get($iArray['user_id'])){
                $aArray[$kArray]['balance_money'] += ($balance_income->get($iArray['user_id']) ?? 0.00);
            }
            //资金明细 - 其它
            foreach ($aCapitalOther as $kCapitalOther => $iCapitalOther){
                if($iArray['user_id'] == $iCapitalOther->to_user){
                    $aArray[$kArray]['other_money'] += $iCapitalOther->other_money ?? 0;
                    $aArray[$kArray]['cai_money'] += $iCapitalOther->cai_money ?? 0;
                }
            }

        }

        foreach ($aArrayBunko as $kArrayBunko => $iArrayBunko){
            foreach ($aRebate as $kRebate => $iRebate){
                if($iArrayBunko['game_id'] == $iRebate->game_id && $iArrayBunko['user_id'] == $iRebate->user_id){
                    $aArrayBunko[$kArrayBunko]['rebate_money'] = $iRebate->money;
                    unset($aRebate[$kRebate]);
                }
            }

            foreach ($aPromotion as $kPromotion => $iPromotion){
                if($iArrayBunko['game_id'] == $iPromotion->game_id && $iArrayBunko['user_id'] == $iPromotion->user_id){
                    $aArrayBunko[$kArrayBunko]['promotion_money'] = $iPromotion->money;
                    unset($aPromotion[$kPromotion]);
                }
            }
        }

        foreach ($aRebate as $iRebate){
            $aArrayBunko[] = [
                'game_id' => $iRebate->game_id,
                'game_name' => $iRebate->game_name,
                'user_id' => $iRebate->user_id,
                'user_account' => $iRebate->user_account,
                'user_name' => $iRebate->user_name,
                'agent_id' => $iRebate->agent_id,
                'gameCategory' => $this->getGameCategoryCode($iRebate->pid),
                'agent_account' => $iRebate->agent_account,
                'agent_name' => $iRebate->agent_name,
                'general_account' => $iRebate->general_account,
                'general_name' => $iRebate->general_name,
                'general_id' => $iRebate->general_id,
                'bet_bunko' => 0.00,
                'bet_money' => 0.00,
                'bet_count' => 0,
                'rebate_money' => $iRebate->money,
                'promotion_money' => 0.00,
                'date' => $this->aDateTime,
                'dateTime' => $time,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ];
        }

        foreach ($aPromotion as $iPromotion){
            $aArrayBunko[] = [
                'game_id' => $iPromotion->game_id,
                'game_name' => empty($iPromotion->game_id) ? '彩票' : $iPromotion->game_name,
                'user_id' => $iPromotion->user_id,
                'user_account' => $iPromotion->user_account,
                'user_name' => $iPromotion->user_name,
                'agent_id' => $iPromotion->agent_id,
                'gameCategory' => $this->getGameCategoryCode($iPromotion->pid),
                'agent_account' => $iPromotion->agent_account,
                'agent_name' => $iPromotion->agent_name,
                'general_account' => $iPromotion->general_account,
                'general_name' => $iPromotion->general_name,
                'general_id' => $iPromotion->general_id,
                'bet_bunko' => 0.00,
                'bet_money' => 0.00,
                'bet_count' => 0,
                'rebate_money' => 0.00,
                'promotion_money' => $iPromotion->money,
                'date' => $this->aDateTime,
                'dateTime' => $time,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ];
        }

        ZhReportMember::where('date','=',$this->aDateTime)->delete();
        ZhReportMemberBunko::where('date','=',$this->aDateTime)->delete();
        $aBunko = array_chunk($aArrayBunko,1000);
        foreach ($aBunko as $iBunko){
            ZhReportMemberBunko::insert($iBunko);
        }
        foreach ($aArray as $kArray => $iArray){
            if($iArray['bet_count'] > 0 || $iArray['recharges_money'] > 0 || $iArray['drawing_money'] > 0 || $iArray['activity_money'] > 0 || $iArray['envelope_money'] > 0 || $iArray['rebate_money'] > 0 || $iArray['promotion_money'] > 0 || $iArray['other_money'] > 0 || $iArray['balance_money'] > 0 || $iArray['cai_money'] > 0)
                ZhReportMemberStatementInsert::dispatch($iArray)->onQueue($this->setQueueRealName('zhReportMemberStatementInsert'));
        }

    }

    //队列真实名
    public function setQueueRealName($queue){
        return config('prefix')['queue'] . $queue;
    }

    public function getGameCategoryCode($pid){
        switch ($pid){
            case 0:
                $code = 'CP';
                break;
            case 1:
                $code = 'PVP';
                break;
            case 2:
                $code = 'LIVE';
                break;
            case 3:
                $code = 'RNG';
                break;
                break;
            case 4:
                $code = 'FISH';
                break;
            case 5:
                $code = 'SPORTS';
                break;
            default:
                $code = 'YOPLAY';
                break;

        }
        return $code;
    }
}
