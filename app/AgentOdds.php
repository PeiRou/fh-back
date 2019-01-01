<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AgentOdds extends Model
{
    protected $table = 'agent_odds';

    public static function getOddsByAgentArray($aAgentId,$agentId){
        $aAgentId[] = $agentId;
        $aData = self::select('agent_odds.agent_id','agent_odds_setting.odds','agent_odds_setting.odds_category_id')->whereIn('agent_odds.agent_id',$aAgentId)
            ->join('agent_odds_setting','agent_odds_setting.id','=','agent_odds.odds_id')->get();
        $aArray = [];
        foreach ($aAgentId as $iAgentId) {
            foreach ($aData as $iData) {
                if($iAgentId == $iData->agent_id)
                    $aArray[$iAgentId][$iData->odds_category_id] = $iData->odds;
            }
        }
        return $aArray;
    }

    public static function getOddsByAgent($agentId){
        $aData = self::select('agent_odds.agent_id','agent_odds_setting.odds','agent_odds_setting.odds_category_id')->where('agent_odds.agent_id',$agentId)
            ->join('agent_odds_setting','agent_odds_setting.id','=','agent_odds.odds_id')->get();
        $aArray = [];
        foreach ($aData as $iData) {
            $aArray[$iData->odds_category_id] = $iData->odds;
        }
        return $aArray;
    }

    public static function getOddsByAgentAndCategory($agentId,$categoryId){
        return self::select('agent_odds_setting.*')
            ->where('agent_odds.agent_id',$agentId)->where('agent_odds.odds_category_id',$categoryId)
            ->join('agent_odds_setting','agent_odds_setting.id','=','agent_odds.odds_id')->first();
    }
}
