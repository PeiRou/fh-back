<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AgentBackwater extends Model
{
    protected $table = 'agent_backwater';

    //获取当前时间数据
    public static function getDataByTime($startTime,$endTime){
        $startTime = date('Ymd', strtotime($startTime));
        $endTime = date('Ymd', strtotime($endTime));
        $aSql = 'SELECT `agent_id`,`to_agent`,`user_id`,`game_id`,SUM(`bet_money`) AS `betMoney`,`issue` FROM `agent_backwater`
                    WHERE `category_id` = 2 AND `issue` >= :startTime AND `issue` <= :endTime
                    GROUP BY `agent_id`,`to_agent`,`user_id`,`game_id`,`issue` ';
        $aArray = [
            'startTime' => $startTime,
            'endTime' => $endTime,
        ];
        return DB::select($aSql,$aArray);
    }

    public static function getAgentBackwaterMoney($gameId,$issue)
    {
        $aSql = "SELECT `agent_id` AS `a_id`,SUM(`money`) AS `money` FROM `agent_backwater` WHERE `game_id` = :gameId AND `issue` = :issue AND status = 1 GROUP BY `agent_id`";
        $aArray = [
            'gameId' => $gameId,
            'issue' => $issue
        ];
        return DB::select($aSql, $aArray);
    }

    public static function getAgentDate($iDate){
        $aSql = 'SELECT `agent`.account,`agent`.name,`agent`.p_agent_id,`back`.* FROM 
                    (
                        SELECT `agent_backwater`.agent_id,
                        COUNT(`agent_backwater`.user_id) AS `count`,
                        SUM(`agent_backwater`.money) AS `money`,
                        SUM(`agent_backwater`.bet_money) AS `bet_money`
                        FROM `agent_backwater`
                        WHERE `agent_backwater`.created_at >= :startTime AND `agent_backwater`.created_at <= :endTime
                        GROUP BY `agent_backwater`.agent_id
                    ) AS `back`
                    JOIN `agent` ON `agent`.a_id = `back`.agent_id';
        $aArray = [
            'startTime' => $iDate,
            'endTime' => $iDate.' 23:59:59',
        ];
        return DB::select($aSql,$aArray);
    }


    public static function getBackGroupByAgentId($startTime = '',$endTime = '',$is_zh = false){
        $aSql = "SELECT LEFT(`updated_at`,10) AS `date`,`agent_id`,SUM(`money`) AS `money` FROM `agent_backwater` WHERE `status` = 1 ";
        $aArray = [];
        if(!empty($startTime)){
            $aSql .= " AND `updated_at` >= :startTime ";
            $aArray['startTime'] = $startTime;
        }
        if(!empty($endTime)){
            $aSql .= " AND `updated_at` <= :endTime ";
            $aArray['endTime'] = $endTime;
        }
        if($is_zh){
            $aSql .= ' AND `category_id` = :category_id ';
            $aArray['category_id'] = $is_zh;
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
