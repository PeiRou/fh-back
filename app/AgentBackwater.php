<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AgentBackwater extends Model
{
    protected $table = 'agent_backwater';

    public static $agentBackwaterStatus = [
        '1' => '成功',
        '2' => '失败'
    ];

    public static function getAgentBackwaterMoney($gameId,$issue){
        $aSql = "SELECT SUM(`money`) as `money`,`agent_id` as `a_id` FROM `agent_backwater` WHERE `game_id` = :gameId AND `issue` = :issue AND `status` = 1 GROUP BY `a_id`";
        $aArray = [
            'gameId' => $gameId,
            'issue' => $issue
        ];
        return DB::select($aSql,$aArray);
    }
}
