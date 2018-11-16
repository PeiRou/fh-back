<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AgentBackwater extends Model
{
    protected $table = 'agent_backwater';

    public static $agentBackwaterStatus = [
        1 => '成功',
        2 => '取消',
    ];

    public static function getAgentBackwaterMoney($gameId,$issue){
        $aSql = "SELECT `agent_id` AS `a_id`,SUM(`money`) AS `money` FROM `agent_backwater` WHERE `game_id` = :gameId AND `issue` = :issue AND status = 1 GROUP BY `agent_id`";
        $aArray = [
            'gameId' => $gameId,
            'issue' => $issue
        ];
        return DB::select($aSql,$aArray);
    }
}
