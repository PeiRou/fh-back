<?php

namespace App\Jobs;

use App\Agent;
use App\AgentBackwater;
use App\AgentOddsLevel;
use App\CapitalAgent;
use App\SystemSetup;
use App\ZhReportAgentBunko;
use App\ZhReportMemberBunko;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class AgentBackwaterThirdDaily implements ShouldQueue
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
        //获取第三方打码量
        $aJqBet = ZhReportMemberBunko::getThirdData($this->aDateTime,$this->aDateTime.' 23:59:59');
        //获取需要返点的代理id
        $aAgentId = [];
        foreach ($aJqBet as $iJqBet){
            $aAgentId[] = $iJqBet->agent_id;
            if(!empty($iJqBet->superior_agent)){
                $aAgentId = array_merge($aAgentId,explode(',',$iJqBet->superior_agent));
            }
        }
        $aAgentId = array_unique($aAgentId);
        //获取代理赔率
        $aAgentOdds = $this->agentOddsSort(AgentOddsLevel::getOddsByAgentId($aAgentId));
        //获取代理返水层级数
        $iLevelNum = SystemSetup::getValueByCode('agent_backwater_level_num');
        //获取当前代理返水
        $aRecode = AgentBackwater::getDataByTime($this->aDateTime,$this->aDateTime.' 23:59:59');
        if(count($aRecode) > 0){
            $aAgentBackwater = $this->recodeYes($aJqBet,$aAgentOdds,$iLevelNum,$aRecode);
        }else{
            $aAgentBackwater = $this->recodeNo($aJqBet,$aAgentOdds,$iLevelNum);
        }
        //获取代理增加金额
        $aAgentMoney = [];
        //代理资金明细
        $aCapitalAgent = [];
        $iTime = date('Y-m-d H:i:s');
        foreach ($aAgentBackwater as $kArray => $iArray){
            if(array_key_exists($iArray['agent_id'],$aAgentMoney))
                $aAgentMoney[$iArray['agent_id']]['balance'] += $iArray['money'];
            else
                $aAgentMoney[$iArray['agent_id']] = [
                    'a_id' => $iArray['agent_id'],
                    'balance' => $iArray['money']
                ];
            $aCapitalAgent[] = [
                'agent_id' => $iArray['agent_id'],
                'order_id' => "ABWT" . date('YmdHis') . rand(10000000, 99999999),
                'type' => 't02',
                'money' => $iArray['money'],
                'balance' => round($iArray['balance'] + $aAgentMoney[$iArray['agent_id']]['balance'],2),
                'content' => '',
                'expan1' => $iArray['game_id'],
                'expan2' => $iArray['issue'],
                'expan3' => $iArray['game_name'],
                'expan4' => '',
                'created_at' => $iTime,
                'updated_at' => $iTime,
            ];
            unset($aAgentBackwater[$kArray]['balance']);
        }
        DB::beginTransaction();
        try{
            AgentBackwater::insert($aAgentBackwater);
            if(count($aAgentMoney) > 0)
                DB::update(Agent::updateFiledBatchStitching($aAgentMoney,['balance'],'a_id'));
            CapitalAgent::insert($aCapitalAgent);
            DB::commit();
            Artisan::call('AgentOdds:AgentBackwaterReport',['date' => $this->aDateTime]);
        }catch (\Exception $exception){
            DB::rollback();
            throw $exception;
        }
    }

    private function recodeYes($aJqBet,$aAgentOdds,$iLevelNum,$aRecode){
        $aData = $this->recodeNo($aJqBet,$aAgentOdds,$iLevelNum);
        $iTime = date('Y-m-d H:i:s');
        $aArray = [];
        foreach ($aData as $kData => $iData){
            foreach ($aRecode as $kRecode => $iRecode){
                if($iData['agent_id'] == $iRecode->agent_id && $iData['to_agent'] == $iRecode->to_agent && $iData['user_id'] == $iRecode->user_id && $iData['game_id'] == $iRecode->game_id){
                    if($iData['bet_money'] > $iRecode->betMoney){
                        $iBetMoney = round($iData['bet_money'] - $iRecode->betMoney,2);
                        $iMoney = $this->getMoney($iBetMoney,$iData['commission']);
                        $aArray[] = [
                            'agent_id' => $iData['agent_id'],
                            'to_agent' => $iData['to_agent'],
                            'user_id' => $iData['user_id'],
                            'balance' => $iData['balance'],
                            'status' => 1,
                            'money' => $iMoney,
                            'game_id' => $iData['game_id'],
                            'game_name' => $iData['game_name'],
                            'issue' => 0,
                            'level' => $iData['level'],
                            'rebate' => $iData['rebate'],
                            'commission' => $iData['commission'],
                            'bet_money' => $iBetMoney,
                            'category_id' => 2,
                            'created_at' => $iTime,
                            'updated_at' => $iTime,
                        ];
                    }
                    unset($aData[$kData]);
                }
            }
        }
        foreach ($aData as $iData){
            $aArray[] = $iData;
        }
        return $aArray;
    }

    private function recodeNo($aJqBet,$aAgentOdds,$iLevelNum){
        $aAgentBackwater = [];
        $iTime = date('Y-m-d H:i:s');
        foreach ($aJqBet as $iJqBet){
            if(empty($aAgentOdds[$iJqBet->agent_id][$iJqBet->game_id])){
                continue;
            }
            $preRebate = $aAgentOdds[$iJqBet->agent_id][$iJqBet->game_id];
            if(!empty($iJqBet->superior_agent)){
                $aAgentId = array_slice(array_reverse(explode(',',$iJqBet->superior_agent),false),0,$iLevelNum);
                $i = 1;
                foreach ($aAgentId as $iAgentId){
                    if(empty($aAgentOdds[$iAgentId][$iJqBet->game_id])){
                        continue;
                    }
                    $iRebate = $aAgentOdds[$iAgentId][$iJqBet->game_id];
                    $iCommission = $this->getCommission($preRebate,$iRebate);
                    $iMoney = $this->getMoney($iJqBet->bet_money,$iCommission);
                    if($iMoney > 0){
                        $aAgentBackwater[] = [
                            'agent_id' => $iAgentId,
                            'to_agent' => $iJqBet->agent_id,
                            'user_id' => $iJqBet->user_id,
                            'status' => 1,
                            'money' => $iMoney,
                            'balance' => $iJqBet->balance,
                            'game_id' => $iJqBet->game_id,
                            'game_name' => $iJqBet->game_name,
                            'issue' => 0,
                            'level' => $i,
                            'rebate' => $iRebate,
                            'commission' => $iCommission,
                            'bet_money' => $iJqBet->bet_money,
                            'category_id' => 2,
                            'created_at' => $iTime,
                            'updated_at' => $iTime,
                        ];
                    }
                    $i++;
                }
            }
        }
        return $aAgentBackwater;
    }

    //代理第三方排序
    private function agentOddsSort($aData){
        $aArray = [];
        foreach ($aData as $iData){
            $aArray[$iData->agent_id][$iData->type] = $iData->rebate;
        }
        return $aArray;
    }

    //获取提成比例
    public function getCommission($preRebate,$curRebate){
        $commission = round($curRebate - $preRebate,2);
        return $commission < 0 ? 0 : $commission;
    }

    //获取金额
    public function getMoney($betMoney,$commission){
        return round($betMoney * $commission / 100,2);
    }
}
