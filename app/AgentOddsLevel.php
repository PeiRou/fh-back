<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AgentOddsLevel extends Model
{
    protected $table = 'agent_odds_level';

    //彩票-获取会员层层赔率
    public static function getAgentOddsUser($aGameId,$aUserId){
        $aSql = 'SELECT `agent_user_odds_level`.user_id,`agent_user_odds_level`.level_id,`play_agent_level`.rebate,`agent`.account,`agent`.name 
                    FROM `agent_user_odds_level`
                    INNER JOIN `play_agent_level` ON `play_agent_level`.id = `agent_user_odds_level`.level_id
                    INNER JOIN `agent` ON `agent`.a_id = `agent_user_odds_level`.agent_id
                    WHERE `agent_user_odds_level`.category_id = 1 AND `agent_user_odds_level`.game_id = :iGameId AND `agent_user_odds_level`.user_id IN (';
        $aArray = [
            'iGameId' => $aGameId
        ];
        foreach ($aUserId as $key => $value){
            if($key === 0)
                $aSql .= ':userId'.$key;
            else
                $aSql .= ',:userId'.$key;
            $aArray['userId'.$key] = $value;
        }
        $aSql .= ')';
        return DB::select($aSql,$aArray);
    }

    //彩票-获取代理层层赔率
    public static function getAgentOdds($aGameId,$aAgentId){
        $aSql = 'SELECT `agent_odds_level`.agent_id,`agent_odds_level`.level_id,`play_agent_level`.rebate,`agent`.account,`agent`.name 
                    FROM `agent_odds_level`
                    INNER JOIN `play_agent_level` ON `play_agent_level`.id = `agent_odds_level`.level_id
                    INNER JOIN `agent` ON `agent`.a_id = `agent_odds_level`.agent_id
                    WHERE `agent_odds_level`.category_id = 1 AND `agent_odds_level`.game_id = :iGameId AND `agent_odds_level`.agent_id IN (';
        $aArray = [
            'iGameId' => $aGameId
        ];
        foreach ($aAgentId as $key => $value){
            if($key === 0)
                $aSql .= ':agentId'.$key;
            else
                $aSql .= ',:agentId'.$key;
            $aArray['agentId'.$key] = $value;
        }
        $aSql .= ')';
        return DB::select($aSql,$aArray);
    }

    //第三方游戏-获取会员层层赔率
    public static function getOddsByAgentIdUser($aUserId){
        if(empty($aUserId))
            return [];
        $aSql = 'SELECT `agent_user_odds_level`.user_id,`play_agent_level`.rebate,`agent_user_odds_level`.type FROM `agent_user_odds_level`
                    INNER JOIN `play_agent_level` ON `play_agent_level`.id = `agent_user_odds_level`.level_id
                    WHERE `agent_user_odds_level`.category_id = 2 AND `agent_user_odds_level`.user_id IN (';
        $aArray = [];
        foreach ($aUserId as $key => $value){
            if($key === 0)
                $aSql .= ':userId'.$key;
            else
                $aSql .= ',:userId'.$key;
            $aArray['userId'.$key] = $value;
        }
        $aSql .= ')';
        return DB::select($aSql,$aArray);
    }

    //第三方游戏-获取层层代理赔率
    public static function getOddsByAgentId($aAgentId){
        if(empty($aAgentId))
            return [];
        $aSql = 'SELECT `agent_odds_level`.agent_id,`play_agent_level`.rebate,`agent_odds_level`.type FROM `agent_odds_level`
                    INNER JOIN `play_agent_level` ON `play_agent_level`.id = `agent_odds_level`.level_id
                    WHERE `agent_odds_level`.category_id = 2 AND `agent_odds_level`.agent_id IN (';
        $aArray = [];
        foreach ($aAgentId as $key => $value){
            if($key === 0)
                $aSql .= ':agentId'.$key;
            else
                $aSql .= ',:agentId'.$key;
            $aArray['agentId'.$key] = $value;
        }
        $aSql .= ')';
        return DB::select($aSql,$aArray);
    }

}
