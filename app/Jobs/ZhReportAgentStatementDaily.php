<?php

namespace App\Jobs;

use App\Agent;
use App\BetHis;
use App\Bets;
use App\Capital;
use App\ChatHongbaoDt;
use App\Drawing;
use App\GamesList;
use App\JqReportBetGame;
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
        //获取聊天室红包
        $aHongBao = ChatHongbaoDt::betAgentReportData($this->aDateTime,$this->aDateTime.' 23:59:59');
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
        $aArray = [];
        $aArrayBunko = [];
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
                'recharges_money' => 0.00,
                'drawing_money' => 0.00,
                'activity_money' => 0.00,
                'envelope_money' => 0.00,
                'bet_bunko' => 0.00,
                'bet_money' => 0.00
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
                }
            }

            foreach ($aHongBao as $iHongBao){
                if($iArray['agent_id'] == $iHongBao->agent && $iArray['date'] == $iHongBao->date){
                    $aArray[$kArray]['envelope_money'] = empty($iHongBao->amount)?0.00:$iHongBao->amount;
                }
            }

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
                        'gameCategory' => 'CP',
                        'rebate_money' => 0,
                        'date' => $iBet->date,
                        'dateTime' => $time,
                        'created_at' => $dateTime,
                        'updated_at' => $dateTime,
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
                        'bet_count' => empty($iJqBet->bet_count)?0:$iJqBet->bet_count,
                        'rebate_money' => 0,
                        'date' => $this->aDateTime,
                        'dateTime' => $time,
                        'created_at' => $dateTime,
                        'updated_at' => $dateTime,
                    ];
                }
            }

            foreach ($aRebate as $iRebate){
                if($iArray['agent_id'] == $iRebate->agent_id){
                    $aArray[$kArray]['rebate_money'] += empty($iRebate->money)?0:$iRebate->money;
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
                'rebate_money' => $iRebate->money,
                'date' => $this->aDateTime,
                'dateTime' => $time,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ];
        }

        ZhReportAgent::where('date','=',$this->aDateTime)->delete();
        ZhReportAgentBunko::where('date','=',$this->aDateTime)->delete();
        $aBunko = array_chunk($aArrayBunko,1000);
        foreach ($aBunko as $iBunko){
            ZhReportAgentBunko::insert($iBunko);
        }
        foreach ($aArray as $kArray => $iArray){
            if($iArray['bet_count'] > 0 || $iArray['recharges_money'] > 0 || $iArray['drawing_money'] > 0 || $iArray['activity_money'] > 0 || $iArray['envelope_money'] > 0 || $iArray['bet_bunko'] > 0 || $iArray['rebate_money'] > 0)
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
