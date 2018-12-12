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

    public static function getBackGroupByAgentId($startTime = '',$endTime = ''){
        $aSql = "SELECT LEFT(`updated_at`,10) AS `date`,`agent_id`,SUM(`money`) AS `money` FROM `agent_backwater` WHERE `status` = 1 ";
        $aArray = [];
        if(empty($startTime)){
            $aSql .= " AND `updated_at` >= :startTime ";
            $aArray['startTime'] = $startTime;
        }
        if(empty($endTime)){
            $aSql .= " AND `updated_at` <= :endTime ";
            $aArray['startTime'] = $endTime;
        }
        $aSql .= " GROUP BY `agent_id`,`date`";
        return DB::select($aSql,$aArray);
    }

    public static function getBackGroupByAgentGame($startTime = '',$endTime = ''){
        $aSql = "SELECT LEFT(`updated_at`,10) AS `date`,`agent_id`,`game_id`,SUM(`money`) AS `money` FROM `agent_backwater` WHERE `status` = 1 ";
        $aArray = [];
        if(empty($startTime)){
            $aSql .= " AND `updated_at` >= :startTime ";
            $aArray['startTime'] = $startTime;
        }
        if(empty($endTime)){
            $aSql .= " AND `updated_at` <= :endTime ";
            $aArray['startTime'] = $endTime;
        }
        $aSql .= " GROUP BY `agent_id`,`date`,`game_id`";
        return DB::select($aSql,$aArray);
    }

    public static function getBackGroupByGeneralId($startTime = '',$endTime = ''){
        $aSql = "SELECT LEFT(`agent_backwater`.`updated_at`,10) AS `date`,SUM(`agent_backwater`.`money`) AS `money`,`agent`.gagent_id AS `g_id` FROM `agent_backwater`
                  JOIN `agent` ON `agent`.a_id = `agent_backwater`.agent_id
                  WHERE `agent_backwater`.status = 1 ";
        $aArray = [];
        if(empty($startTime)){
            $aSql .= " AND `agent_backwater`.`updated_at` >= :startTime ";
            $aArray['startTime'] = $startTime;
        }
        if(empty($endTime)){
            $aSql .= " AND `agent_backwater`.`updated_at` <= :endTime ";
            $aArray['startTime'] = $endTime;
        }
        $aSql .= " GROUP BY `g_id`,`date`";
        return DB::select($aSql,$aArray);
    }

    public static function getBackGroupByGeneralGame($startTime = '',$endTime = ''){
        $aSql = "SELECT LEFT(`agent_backwater`.`updated_at`,10) AS `date`,SUM(`agent_backwater`.`money`) AS `money`,`agent_backwater`.game_id,`agent`.gagent_id AS `g_id` FROM `agent_backwater`
                  JOIN `agent` ON `agent`.a_id = `agent_backwater`.agent_id
                  WHERE `agent_backwater`.status = 1 ";
        $aArray = [];
        if(empty($startTime)){
            $aSql .= " AND `agent_backwater`.`updated_at` >= :startTime ";
            $aArray['startTime'] = $startTime;
        }
        if(empty($endTime)){
            $aSql .= " AND `agent_backwater`.`updated_at` <= :endTime ";
            $aArray['startTime'] = $endTime;
        }
        $aSql .= " GROUP BY `g_id`,`date`,`game_id`";
        return DB::select($aSql,$aArray);
    }
}
