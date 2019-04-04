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
                     `games_api`.`g_id` AS `game_id`, `games_api`.`name` AS `game_name`
                     FROM 
                        (SELECT `g_id`,`user_id`,SUM(`AllBet`) AS `bet_money`,SUM(`bunko`) AS `bet_bunko`,SUM(`bet_money`) AS `bet_count`
                            FROM `jq_bet` WHERE `updated_at` >= :startTime AND `updated_at` <= :endTime GROUP BY `user_id`,`g_id`
                            ) AS `jq`
                    JOIN `users` ON `users`.`id` = `jq`.`user_id`
                    JOIN `agent` ON `agent`.`a_id` = `users`.`agent`
                    JOIN `games_api` ON `games_api`.`g_id` = `jq`.`g_id`";
        $aArray = [
            'startTime' => $startTime,
            'endTime' => $endTime
        ];
        return DB::select($aSql,$aArray);
    }

    public static function reportQuerySelect($aParam){
        $aSql = "SELECT `user_id` FROM `jq_bet` WHERE 1 ";
        $aArray = [
            'start' => $aParam['start'],
            'length' => $aParam['length']
        ];
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
        $aSql .= " GROUP BY `user_id` ORDER BY `user_id` ASC LIMIT :start,:length";
        $aUserId = DB::select($aSql,$aArray);
        $aData = [];
        foreach ($aUserId as $iUserId){
            $aData[] = $iUserId->user_id;
        }
        return $aData;
    }

    public static function reportQuery($userId,$aParam){
        $aSql = "SELECT `jq`.`bet_money`,`jq`.`bet_bunko`,`jq`.`bet_bunko`,`jq`.`bet_count`,
                    `users`.`name` AS `user_name`,`users`.`id` AS `user_id`,`users`.`username` AS `user_account`,
                     `agent`.`a_id` AS `agent_id`,`agent`.`account` AS `agent_account`,`agent`.`name` AS `agent_name`,
                     `games_api`.`g_id` AS `game_id`, `games_api`.`name` AS `game_name`
                    FROM (SELECT `g_id`,`user_id`,SUM(`AllBet`) AS `bet_money`,SUM(`bunko`) AS `bet_bunko`,SUM(`bet_money`) AS `bet_count` 
                    FROM `jq_bet` WHERE 1 ";
        $aArray = [];
        if(!empty($userId)){
            $aSql .= "AND `user_id` IN (".$userId.")";
        }
        if(isset($aParam['startTime']) && array_key_exists('startTime',$aParam)){
            $aSql .= " AND `updated_at` >= :startTime ";
            $aArray['startTime'] = $aParam['startTime'];
        }
        if(isset($aParam['endTime']) && array_key_exists('endTime',$aParam)){
            $aSql .= " AND `updated_at` <= :endTime ";
            $aArray['endTime'] = $aParam['endTime'].' 23:59:59';
        }
        $aSql .= " GROUP BY `user_id`,`g_id`) AS `jq`
                   JOIN `users` ON `users`.`id` = `jq`.`user_id`
                   JOIN `agent` ON `agent`.`a_id` = `users`.`agent`
                   JOIN `games_api` ON `games_api`.`g_id` = `jq`.`g_id`";
        return DB::select($aSql,$aArray);
    }

    public static function reportQueryCount($aParam){
        $aSql = "SELECT COUNT(`jq`.`user_id`) AS `count` FROM (SELECT `user_id` FROM `jq_bet` WHERE 1 ";
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
        $aSql .= " GROUP BY `user_id`) AS `jq`";
        return DB::select($aSql,$aArray)[0]->count;
    }

    public static function reportQuerySum($aParam){
        $aSql = "SELECT SUM(`AllBet`) AS `bet_money`,SUM(`bunko`) AS `bet_bunko`,SUM(`bet_money`) AS `bet_count`,`g_id` AS `game_id` FROM `jq_bet` WHERE 1";
        $aArray =[];
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
        $aSql .= " GROUP BY `g_id`";
        return DB::select($aSql,$aArray);
    }
}
