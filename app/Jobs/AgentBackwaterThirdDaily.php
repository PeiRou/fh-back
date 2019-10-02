<?php

namespace App\Jobs;

use App\AgentBackwater;
use App\AgentOddsLevel;
use App\SystemSetup;
use App\ZhReportAgentBunko;
use App\ZhReportMemberBunko;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

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
        $aBackwater = AgentBackwater::getDataByTime($this->aDateTime,$this->aDateTime.' 23:59:59');
        if(count($aBackwater) > 0){

        }
    }

    //代理第三方排序
    private function agentOddsSort($aData){
        $aArray = [];
        foreach ($aData as $iData){
            $aArray[$iData->agent_id][$iData->type] = $iData->rebate;
        }
        return $aArray;
    }
}
