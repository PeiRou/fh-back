<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AgentBackwater extends Model
{
    protected $table = 'agent_backwater';

    //获取当前时间数据
    public static function getDataByTime($startTime,$endTime){
        $aSql = 'SELECT `agent_id`,`to_agent`,`user_id`,`game_id`,SUM(`bet_money`) AS `betMoney` FROM `agent_backwater`
                    WHERE `category_id` = 2 AND `created_at` >= :startTime AND `created_at` <= :endTime
                    GROUP BY `agent_id`,`to_agent`,`user_id`,`game_id`';
        $aArray = [
            'startTime' => $startTime,
            'endTime' => $endTime,
        ];
        return DB::select($aSql,$aArray);
    }
}
