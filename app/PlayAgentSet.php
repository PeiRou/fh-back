<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PlayAgentSet extends Model
{
    protected $table = 'play_agent_set';

    //获取代理赔率
    public static function getAgentSetOdds($gameId,$agentId){
        $aSql = "SELECT `play`.odds,`play`.rebate,`play`.odds_tag,`play`.rebate_tag,`agentSet`.odds AS `agentOdds`,`agentSet`.rebate AS `agentRebate` FROM `play` 
                  LEFT JOIN (SELECT `odds`,`rebate`,`paly_code` FROM `play_agent_set` WHERE `game_id` = :agentGameId AND `agent_id` = :agentId) AS `agentSet` 
                    ON `agentSet`.paly_code = `play`.odds_tag
                  WHERE `play`.gameId = :gameId ";
        $aArray = [
            'agentGameId' => $gameId,
            'agentId' =>$agentId,
            'gameId' => $gameId
        ];
        return DB::select($aSql,$aArray);
    }
}
