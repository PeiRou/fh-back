<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class JqBet extends Model
{
    protected $table = 'jq_bet';

    protected $primaryKey = 'id';

    public static function getOnly($g_id){
        return self::where('g_id', $g_id)
            ->pluck('GameID');
    }

    public static function jqReportData($startTime,$endTime){
        $aSql = "SELECT `jq`.`bet_money`,`jq`.`bet_bunko`,`jq`.`bet_count`,
                    `users`.`name` AS `user_name`,`users`.`id` AS `user_id`,`users`.`username` AS `user_account`,
                     `agent`.`a_id` AS `agent_id`,`agent`.`account` AS `agent_account`,`agent`.`name` AS `agent_name`,
                     `games_api`.`g_id` AS `game_id`, `games_api`.`name` AS `game_name`,
                     `capital`.`up_amount` AS `up_amount`,`capital`.`down_amount` AS `down_amount`
                     FROM 
                        (SELECT `g_id`,`user_id`,COUNT(`id`) AS `bet_count`,SUM(`bunko`) AS `bet_bunko`,SUM(`bet_money`) AS `bet_money`
                            FROM `jq_bet` WHERE `updated_at` >= :startTime AND `updated_at` <= :endTime GROUP BY `user_id`,`g_id` ORDER BY `user_id` 
                            ) AS `jq`
                    JOIN `users` ON `users`.`id` = `jq`.`user_id`
                    JOIN `agent` ON `agent`.`a_id` = `users`.`agent`
                    JOIN `games_api` ON `games_api`.`g_id` = `jq`.`g_id`
                    JOIN (SELECT `userid`,`g_id`,SUM(CASE WHEN `type` = 1 THEN `amount` ELSE 0 END) AS `up_amount`,SUM(CASE WHEN `type` = 2 THEN `amount` ELSE 0 END) AS `down_amount` FROM `jq_capital` 
                        WHERE `date` >= :startTime1 AND `date` <= :endTime1 GROUP BY `userid`,`g_id`) AS `capital`
                        ON `capital`.`userid` = `jq`.`user_id` AND `capital`.`g_id` = `jq`.`g_id`";
        $aArray = [
            'startTime' => $startTime,
            'endTime' => $endTime,
            'startTime1' => $startTime,
            'endTime1' => $endTime
        ];
        return DB::select($aSql,$aArray);
    }

    public static function reportQuerySelect($aParam){
        $aSql = "SELECT `user_id` FROM `jq_bet` WHERE 1 ";
        isset($aParam['start'], $aParam['length']) && $aArray = [
            'start' => $aParam['start'],
            'length' => $aParam['length']
        ];
        if(isset($aParam['user_account']) && array_key_exists('user_account',$aParam)){
            $aSql .= " AND `username` = :user_account ";
            $aArray['user_account'] = $aParam['user_account'];
        }
        if(isset($aParam['agent_account']) && array_key_exists('agent_account',$aParam)){
            $aSql .= " AND `agent_account` = :agent_account ";
            $aArray['agent_account'] = $aParam['agent_account'];
        }
        if(isset($aParam['startTime']) && array_key_exists('startTime',$aParam)){
            $aSql .= " AND `updated_at` >= :startTime ";
            $aArray['startTime'] = $aParam['startTime'];
        }
        if(isset($aParam['endTime']) && array_key_exists('endTime',$aParam)){
            $aSql .= " AND `updated_at` <= :endTime ";
            $aArray['endTime'] = $aParam['endTime'].' 23:59:59';
        }
        $aSql .= " GROUP BY `user_id` ORDER BY `user_id` ASC ";
        isset($aArray['start'], $aArray['length']) && $aSql .= "LIMIT :start,:length";
        $aUserId = DB::select($aSql,$aArray);
        $aData = [];
        foreach ($aUserId as $iUserId){
            $aData[] = $iUserId->user_id;
        }
        return $aData;
    }

    public static function reportQuery($userId,$aParam){
        $aSql = "SELECT `jq`.`bet_bunko`,`jq`.`bet_money`,`users`.`name` AS `user_name`,`users`.`id` AS `user_id`,`users`.`username` AS `user_account`,
                     `agent`.`a_id` AS `agent_id`,`agent`.`account` AS `agent_account`,`agent`.`name` AS `agent_name`,
                     `games_api`.`g_id` AS `game_id`, `games_api`.`name` AS `game_name`,
                     `capital`.`up_amount` AS `up_fraction`,`capital`.`down_amount` AS `down_fraction`
                    FROM (SELECT `g_id`,`user_id`,SUM(`bunko`) AS `bet_bunko`,SUM(`bet_money`) AS `bet_money`
                    FROM `jq_bet` WHERE 1 ";
        $aArray = [];
        $aSql1 = '';
        if(!empty($userId)){
            $aSql .= " AND `user_id` IN (".$userId.")";
            $aSql1 .= " AND `userid` IN (".$userId.")";
        }
        if(isset($aParam['startTime']) && array_key_exists('startTime',$aParam)){
            $aSql .= " AND `updated_at` >= :startTime ";
            $aArray['startTime'] = $aParam['startTime'];
            $aSql1 .= " AND `date` >= :startTime1";
            $aArray['startTime1'] = $aParam['startTime'];
        }
        if(isset($aParam['endTime']) && array_key_exists('endTime',$aParam)){
            $aSql .= " AND `updated_at` <= :endTime ";
            $aArray['endTime'] = $aParam['endTime'].' 23:59:59';
            $aSql1 .= " AND `date` <= :endTime1";
            $aArray['endTime1'] = $aParam['endTime'].' 23:59:59';
        }
        $aSql .= " GROUP BY `user_id`,`g_id`) AS `jq`
                   JOIN `users` ON `users`.`id` = `jq`.`user_id`
                   JOIN `agent` ON `agent`.`a_id` = `users`.`agent`
                   JOIN `games_api` ON `games_api`.`g_id` = `jq`.`g_id`
                   JOIN (SELECT `userid`,`g_id`,SUM(CASE WHEN `type` = 1 THEN `amount` ELSE 0 END) AS `up_amount`,SUM(CASE WHEN `type` = 2 THEN `amount` ELSE 0 END) AS `down_amount` FROM `jq_capital` 
                        WHERE 1  ".$aSql1." GROUP BY `userid`,`g_id`) AS `capital`
                        ON `capital`.`userid` = `jq`.`user_id` AND `capital`.`g_id` = `jq`.`g_id`";
        return DB::select($aSql,$aArray);
    }

    public static function reportQueryCount($aParam){
        $aSql = "SELECT COUNT(`jq`.`user_id`) AS `count` FROM (SELECT `user_id` FROM `jq_bet` WHERE 1 ";
        $aArray = [];
        if(isset($aParam['user_account']) && array_key_exists('user_account',$aParam)){
            $aSql .= " AND `username` = :user_account ";
            $aArray['user_account'] = $aParam['user_account'];
        }
        if(isset($aParam['agent_account']) && array_key_exists('agent_account',$aParam)){
            $aSql .= " AND `agent_account` = :agent_account ";
            $aArray['agent_account'] = $aParam['agent_account'];
        }
        if(isset($aParam['startTime']) && array_key_exists('startTime',$aParam)){
            $aSql .= " AND `updated_at` >= :startTime ";
            $aArray['startTime'] = $aParam['startTime'];
        }
        if(isset($aParam['endTime']) && array_key_exists('endTime',$aParam)){
            $aSql .= " AND `updated_at` <= :endTime ";
            $aArray['endTime'] = $aParam['endTime'].' 23:59:59';
        }
        $aSql .= " GROUP BY `user_id`) AS `jq`";
        return DB::select($aSql,$aArray)[0]->count;
    }

    public static function reportQuerySum($aParam){
        $aSql = "SELECT `jq`.`bet_bunko`,`jq`.`bet_money`,`jq`.game_id,`jq`.ratio_money,`capital`.`up_fraction`,`capital`.`down_fraction` FROM (SELECT SUM(`bunko`) AS `bet_bunko`,SUM(`ratio_money`) AS `ratio_money`,SUM(`bet_money`) AS `bet_money`,`g_id` AS `game_id` FROM `jq_bet` WHERE 1";
        $aArray =[];
        $aSql1 = '';
        if(isset($aParam['user_account']) && array_key_exists('user_account',$aParam)){
            $aSql .= " AND `username` = :user_account ";
            $aArray['user_account'] = $aParam['user_account'];
            $aSql1 .= " AND `username` = :user_account1";
            $aArray['user_account1'] = $aParam['user_account'];
        }
        if(isset($aParam['agent_account']) && array_key_exists('agent_account',$aParam)){
            $aSql .= " AND `agent_account` = :agent_account ";
            $aArray['agent_account'] = $aParam['agent_account'];
            $aSql1 .= " AND `agent_account` = :agent_account1";
            $aArray['agent_account1'] = $aParam['agent_account'];
        }
        if(isset($aParam['startTime']) && array_key_exists('startTime',$aParam)){
            $aSql .= " AND `updated_at` >= :startTime ";
            $aArray['startTime'] = $aParam['startTime'];
            $aSql1 .= " AND `date` >= :startTime1";
            $aArray['startTime1'] = $aParam['startTime'];
        }
        if(isset($aParam['endTime']) && array_key_exists('endTime',$aParam)){
            $aSql .= " AND `updated_at` <= :endTime ";
            $aArray['endTime'] = $aParam['endTime'].' 23:59:59';
            $aSql1 .= " AND `date` <= :endTime1";
            $aArray['endTime1'] = $aParam['endTime'].' 23:59:59';
        }
        $aSql .= " GROUP BY `g_id`) AS `jq` JOIN 
                    (SELECT g_id,SUM(CASE WHEN `type` = 1 THEN `amount` ELSE 0 END) AS `up_fraction`,SUM(CASE WHEN `type` = 2 THEN `amount` ELSE 0 END) AS `down_fraction`
                    FROM `jq_capital` WHERE 1 ".$aSql1." GROUP BY `g_id`) AS `capital` 
                    ON `capital`.`g_id` = `jq`.`game_id`";
        return DB::select($aSql,$aArray);
    }

    public static function excelQuery($aParam){
        $aSql = "SELECT `jq`.`bet_money`,`jq`.`bet_bunko`,`jq`.`bet_bunko`,`jq`.`bet_count`,
                    `users`.`name` AS `user_name`,`users`.`id` AS `user_id`,`users`.`username` AS `user_account`,
                     `agent`.`a_id` AS `agent_id`,`agent`.`account` AS `agent_account`,`agent`.`name` AS `agent_name`,
                     `games_api`.`g_id` AS `game_id`, `games_api`.`name` AS `game_name`
                    FROM (SELECT `g_id`,`user_id`,SUM(`AllBet`) AS `bet_money`,SUM(`bunko`) AS `bet_bunko`,SUM(`bet_money`) AS `bet_count` 
                            FROM `jq_bet` WHERE 1 ";
        $aArray = [];
        if(isset($aParam['user_account']) && array_key_exists('user_account',$aParam)){
            $aSql .= " AND `username` = :user_account ";
            $aArray['user_account'] = $aParam['user_account'];
        }
        if(isset($aParam['startTime']) && array_key_exists('startTime',$aParam)){
            $aSql .= " AND `updated_at` >= :startTime ";
            $aArray['startTime'] = $aParam['startTime'];
        }
        if(isset($aParam['endTime']) && array_key_exists('endTime',$aParam)){
            $aSql .= " AND `updated_at` <= :endTime ";
            $aArray['endTime'] = $aParam['endTime'].' 23:59:59';
        }
        $aSql .= " GROUP BY `user_id`,`g_id` ORDER BY `user_id`) AS `jq`
                   JOIN `users` ON `users`.`id` = `jq`.`user_id`
                   JOIN `agent` ON `agent`.`a_id` = `users`.`agent`
                   JOIN `games_api` ON `games_api`.`g_id` = `jq`.`g_id`";
        return DB::select($aSql,$aArray);
    }
}
