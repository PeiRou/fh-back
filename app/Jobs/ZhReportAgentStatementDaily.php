<?php

namespace App\Jobs;

use App\Agent;
use App\AgentBackwater;
use App\BalanceIncomeDay;
use App\BetHis;
use App\Bets;
use App\Capital;
use App\ChatHongbaoDt;
use App\Drawing;
use App\GamesList;
use App\JqReportBetGame;
use App\PromotionRecode;
use App\Recharges;
use App\ThirdRebate;
use App\ZhReportAgent;
use App\ZhReportAgentBunko;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;
use SameClass\Config\GamesListConfig\GamesListConfig;
use SameClass\Model\CapitalModel;

class ZhReportAgentStatementDaily implements ShouldQueue
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
        //获取充值金额
        $aRecharges = Recharges::betAgentReportData($this->aDateTime,$this->aDateTime.' 23:59:59');
        //获取提款金额
        $aDrawing = Drawing::betAgentReportData($this->aDateTime,$this->aDateTime.' 23:59:59');
        //获取活动金额
        $aActivity = Capital::betAgentReportData($this->aDateTime,$this->aDateTime.' 23:59:59');
        //获取代理返水金额
        $aBack = AgentBackwater::getZHBackGroupByAgentId($this->aDateTime,$this->aDateTime.' 23:59:59');
        //获取聊天室红包
        //$aHongBao = ChatHongbaoDt::betAgentReportData($this->aDateTime,$this->aDateTime.' 23:59:59');
//        $aHongBao = Capital::betAgentReportHongBaoData($this->aDateTime,$this->aDateTime.' 23:59:59');
        //获取彩票投注
        if(strtotime($this->aDateTime) >= strtotime(date('Y-m-d')))
            $aBet = Bets::betAgentReportData($this->aDateTime,$this->aDateTime.' 23:59:59');
        else
            $aBet = BetHis::betAgentReportData($this->aDateTime,$this->aDateTime.' 23:59:59');
        //获取棋牌投注
        $aJqBet = JqReportBetGame::betAgentReportData($this->aDateTime,$this->aDateTime.' 23:59:59');
        //棋牌游戏分类字符
        $aGameCategory = GamesList::getCategoryArray();
        //获取游戏名
        $aGameName = GamesList::getNameArray();
        //第三方返水
        $aRebate = ThirdRebate::agentReportData($this->aDateTime,$this->aDateTime.' 23:59:59');
        //会员推广返佣
        $aPromotion = PromotionRecode::agentReportData($this->aDateTime,$this->aDateTime.' 23:59:59');
        # 资金明细可以取到的 其它金额
        $aCapitalOther = Capital::betAgentReportOtherData($this->aDateTime,$this->aDateTime.' 23:59:59', CapitalModel::capitalOtherTypes);
        # 余额宝盈利
        $balance_income = BalanceIncomeDay::betAgentReportData($this->aDateTime);

        $aArray = [];
        $aArrayBunko = [];
        $aBackBunko = [];
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
                'rebate_money' => 0.00,
                'promotion_money' => 0.00,
                'recharges_money' => 0.00,
                'drawing_money' => 0.00,
                'activity_money' => 0.00,
                'envelope_money' => 0.00,
                'bet_bunko' => 0.00,
                'bet_money' => 0.00,
                'other_money' => 0.00,
                'balance_money' => 0.00,
                'cai_money' => 0.00,
                'return_amount' => 0.00
            ];
        }
        foreach ($aArray as $kArray => $iArray){
            foreach ($aRecharges as $iRecharges){
                if($iArray['agent_id'] == $iRecharges->agentId && $iArray['date'] == $iRecharges->date){
                    $aArray[$kArray]['recharges_money'] = empty($iRecharges->reAmountSum)?0.00:$iRecharges->reAmountSum;
                }
            }

            foreach ($aDrawing as $iDrawing){
                if($iArray['agent_id'] == $iDrawing->agentId && $iArray['date'] == $iDrawing->date){
                    $aArray[$kArray]['drawing_money'] = empty($iDrawing->drAmountSum)?0.00:$iDrawing->drAmountSum;
                }
            }

            foreach ($aActivity as $iActivity){
                if($iArray['agent_id'] == $iActivity->agentId && $iArray['date'] == $iActivity->date){
                    $aArray[$kArray]['activity_money'] = empty($iActivity->sumActivity)?0.00:$iActivity->sumActivity;
                    $aArray[$kArray]['handling_fee'] = empty($iActivity->sumRecharge_fee)?0.00:$iActivity->sumRecharge_fee;
                    $aArray[$kArray]['envelope_money'] = empty($iActivity->sumAmount)?0.00:$iActivity->sumAmount;
                }
            }
            foreach ($aBack as $kBack => $iBack){
                if($iArray['agent_id'] == $iBack->agent_id && $iArray['date'] == $iBack->date){
                    $aArray[$kArray]['return_amount'] += empty($iBack->money)?0.00:$iBack->money;
                    $iBack->agent_account = $iArray['agent_account'];
                    $iBack->agent_name = $iArray['agent_name'];
                    $iBack->general_account = $iArray['general_account'];
                    $iBack->general_name = $iArray['general_name'];
                    $iBack->general_id = $iArray['general_id'];
                }
            }
//            foreach ($aHongBao as $iHongBao){
//                if($iArray['agent_id'] == $iHongBao->agent && $iArray['date'] == $iHongBao->date){
//                    $aArray[$kArray]['envelope_money'] = empty($iHongBao->amount)?0.00:$iHongBao->amount;
//                }
//            }

            foreach ($aBet as $iBet){
                if($iArray['agent_id'] == $iBet->agentId && $iArray['date'] == $iBet->date){
                    $aArray[$kArray]['bet_count'] = empty($iBet->idCount)?0:$iBet->idCount;
                    $aArray[$kArray]['bet_money'] = empty($iBet->betMoneySum)?0.00:$iBet->betMoneySum;
                    $sumBunko = empty($iBet->sumBunko)?0.00:$iBet->sumBunko;
                    $back_money = empty($iBet->back_money)?0.00:$iBet->back_money;
                    $aArray[$kArray]['bet_bunko'] = round($sumBunko + $back_money,2);
                    $aArrayBunko[] = [
                        'game_id' => 0,
                        'game_name' => '彩票',
                        'agent_id' => $iBet->agentId,
                        'agent_account' => $iArray['agent_account'],
                        'agent_name' => $iArray['agent_name'],
                        'general_account' => $iArray['general_account'],
                        'general_name' => $iArray['general_name'],
                        'general_id' => $iArray['general_id'],
                        'bet_bunko' => round($sumBunko + $back_money,2),
                        'bet_count' => empty($iBet->idCount)?0:$iBet->idCount,
                        'bet_money' => empty($iBet->betMoneySum)?0.00:$iBet->betMoneySum,
                        'bonus_amount' => empty($iBet->sumWinbet)?0.00:$iBet->sumWinbet,
                        'gameCategory' => 'CP',
                        'rebate_money' => 0,
                        'promotion_money' => 0,
                        'date' => $iBet->date,
                        'dateTime' => $time,
                        'created_at' => $dateTime,
                        'updated_at' => $dateTime,
                        'return_amount' => 0.00
                    ];
                }
            }

            foreach ($aJqBet as $iJqBet){
                if($iArray['agent_id'] == $iJqBet->agent_id && !empty($iJqBet->gameslist_id)){
                    $aArray[$kArray]['bet_count'] += empty($iJqBet->bet_count)?0:$iJqBet->bet_count;
                    $aArray[$kArray]['bet_money'] += empty($iJqBet->bet_money)?0:$iJqBet->bet_money;
                    $aArray[$kArray]['bet_bunko'] += empty($iJqBet->bet_bunko)?0.00:$iJqBet->bet_bunko;
                    $aArrayBunko[] = [
                        'game_id' => $iJqBet->gameslist_id,
                        'game_name' => (isset($aGameCategory[$iJqBet->gameslist_id])?$aGameCategory[$iJqBet->gameslist_id]:'默认分类').'_'.(isset($aGameName[$iJqBet->gameslist_id])?$aGameName[$iJqBet->gameslist_id]:'默认游戏'),
                        'agent_id' => $iJqBet->agent_id,
                        'gameCategory' => $iJqBet->gameCategory,
                        'agent_account' => $iArray['agent_account'],
                        'agent_name' => $iArray['agent_name'],
                        'general_account' => $iArray['general_account'],
                        'general_name' => $iArray['general_name'],
                        'general_id' => $iArray['general_id'],
                        'bet_bunko' => empty($iJqBet->bet_bunko)?0.00:$iJqBet->bet_bunko,
                        'bet_money' => empty($iJqBet->bet_money)?0.00:$iJqBet->bet_money,
                        'bonus_amount' => empty($iJqBet->bonus_amount)?0.00:$iJqBet->bonus_amount,
                        'bet_count' => empty($iJqBet->bet_count)?0:$iJqBet->bet_count,
                        'rebate_money' => 0,
                        'promotion_money' => 0,
                        'date' => $this->aDateTime,
                        'dateTime' => $time,
                        'created_at' => $dateTime,
                        'updated_at' => $dateTime,
                        'return_amount' => 0.00
                    ];
                }
            }

            foreach ($aRebate as $iRebate){
                if($iArray['agent_id'] == $iRebate->agent_id){
                    $aArray[$kArray]['rebate_money'] += empty($iRebate->money)?0:$iRebate->money;
                }
            }

            foreach ($aPromotion as $iPromotion){
                if($iArray['agent_id'] == $iPromotion->agent_id){
                    $aArray[$kArray]['promotion_money'] += empty($iPromotion->money)?0:$iPromotion->money;
                }
            }

            foreach ($aCapitalOther as $kCapitalOther => $iCapitalOther){
                if($iArray['agent_id'] == $iCapitalOther->agentId && $iArray['date'] == $iCapitalOther->date){
                    $aArray[$kArray]['other_money'] = empty($iCapitalOther->other_money)?0.00:$iCapitalOther->other_money;
                    $aArray[$kArray]['cai_money'] = empty($iCapitalOther->cai_money)?0.00:$iCapitalOther->cai_money;
                }
            }
            foreach ($balance_income as $kbalance_income => $ibalance_income){
                if($iArray['agent_id'] == $ibalance_income->agent && $iArray['date'] == $ibalance_income->date){
                    $aArray[$kArray]['balance_money'] = empty($ibalance_income->money)?0.00:$ibalance_income->money;
                }
            }
        }

        foreach ($aArrayBunko as $kArrayBunko => $iArrayBunko){
            foreach ($aRebate as $kRebate => $iRebate){
                if($iArrayBunko['game_id'] == $iRebate->game_id && $iArrayBunko['agent_id'] == $iRebate->agent_id){
                    $aArrayBunko[$kArrayBunko]['rebate_money'] = $iRebate->money;
                    unset($aRebate[$kRebate]);
                }
            }
        }

        foreach ($aRebate as $iRebate){
            $aArrayBunko[] = [
                'game_id' => $iRebate->game_id,
                'game_name' => $iRebate->game_name,
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
                'promotion_money' => 0,
                'rebate_money' => $iRebate->money,
                'date' => $this->aDateTime,
                'dateTime' => $time,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
                'return_amount' => 0.00
            ];
        }

        foreach ($aArrayBunko as $kArrayBunko => $iArrayBunko){
            foreach ($aPromotion as $kPromotion => $iPromotion){
                if($iArrayBunko['game_id'] == $iPromotion->game_id && $iArrayBunko['agent_id'] == $iPromotion->agent_id){
                    $aArrayBunko[$kArrayBunko]['promotion_money'] = $iPromotion->money;
                    unset($aPromotion[$kPromotion]);
                }
            }
        }

        foreach ($aPromotion as $iPromotion){
            foreach ($aArrayBunko as $kArrayBunko => $iArrayBunko){
                if(
                    $iArrayBunko['game_id'] == $iPromotion->game_id
                    && $iArrayBunko['agent_id'] == $iPromotion->agent_id
                ){
                    $aArrayBunko[$kArrayBunko]['promotion_money'] += $iPromotion->money;
                    continue 2;
                }
            }
            $aArrayBunko[] = [
                'game_id' => $iPromotion->game_id,
                'game_name' => empty($iPromotion->game_id) ? '彩票' : $iPromotion->game_name,
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
                'promotion_money' => $iPromotion->money,
                'rebate_money' => 0,
                'date' => $this->aDateTime,
                'dateTime' => $time,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
                'return_amount' => 0.00
            ];
        }
        foreach ($aBack as $kBack => $iBack){
            if($iBack->category_id == 1){
                $iBack->game_id = 0;
                $iBack->game_name = '彩票';
            }else{
                $iBack->game_name = ((isset($aGameCategory[$iBack->game_id])?$aGameCategory[$iBack->game_id]:'默认分类').'_'.$aGameName[$iBack->game_id]) ?? '默认游戏';
            }
            foreach ($aArrayBunko as $kArrayBunko => $iArrayBunko){
                if(
                    $iArrayBunko['game_id'] == $iBack->game_id
                    && $iArrayBunko['agent_id'] == $iBack->agent_id
                    && $iArrayBunko['date'] == $iBack->date
                ){
                    $aArrayBunko[$kArrayBunko]['return_amount'] += $iBack->money;
                    continue 2;
                }
            }
            $aArrayBunko[] = [
                'game_id' => $iBack->game_id,
                'game_name' => $iBack->game_name,
                'agent_id' => $iBack->agent_id,
                'gameCategory' => $this->getGameCategoryCode($iBack->pid),
                'agent_account' => $iBack->agent_account,
                'agent_name' => $iBack->agent_name,
                'general_account' => $iBack->general_account,
                'general_name' => $iBack->general_name,
                'general_id' => $iBack->general_id,
                'bet_bunko' => 0.00,
                'bet_money' => 0.00,
                'bet_count' => 0,
                'promotion_money' => 0,
                'rebate_money' => 0,
                'date' => $iBack->date,
                'dateTime' => $time,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
                'return_amount' => $iBack->money
            ];
        }
        ZhReportAgent::where('date','=',$this->aDateTime)->delete();
        ZhReportAgentBunko::where('date','=',$this->aDateTime)->delete();
        $aBunko = array_chunk($aArrayBunko,1000);
        foreach ($aBunko as $iBunko){
            ZhReportAgentBunko::insert($iBunko);
        }
        foreach ($aArray as $kArray => $iArray){
            if($iArray['bet_count'] > 0 || $iArray['recharges_money'] > 0 || $iArray['drawing_money'] > 0 || $iArray['activity_money'] > 0 || $iArray['envelope_money'] > 0 || $iArray['bet_bunko'] > 0 || $iArray['rebate_money'] > 0 || $iArray['promotion_money'] > 0 || $iArray['other_money'] > 0 || $iArray['balance_money'] > 0 || $iArray['cai_money'] > 0 || $iArray['return_amount'] > 0)
                ZhReportAgentStatementInsert::dispatch($iArray)->onQueue($this->setQueueRealName('zhReportAgentStatementInsert'));
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
