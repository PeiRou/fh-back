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

    public static function getAgentDate($iDate){
        $aSql = 'SELECT `agent`.account,`agent`.name,`agent`.p_agent_id,`back`.* FROM 
                    (
                        SELECT `agent_backwater_report`.agent_id,`agent`.account,`agent`.name,SUM(`agent_backwater_report`.id) AS `count`,
                        SUM(`agent_backwater_report`.money) AS `money`,SUM(`agent_backwater_report`.bet_money) AS `bet_money`
                        FROM `agent_backwater_report`
                        WHERE `agent_backwater_report`.created_at >= :startTime AND `agent_backwater_report`.created_at <= :endTime
                        GROUP BY `agent_backwater_report`.agent_id
                    ) AS `back`
                    JOIN `agent` ON `agent`.a_id = `agent_backwater_report`.agent_id';
        $aArray = [
            'startTime' => $iDate,
            'endTime' => $iDate.' 23:59:59',
        ];
        return DB::select($aSql,$aArray);
    }
}
