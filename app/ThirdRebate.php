<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ThirdRebate extends Model
{
    protected $table = 'third_rebate';

    public static function betMemberReportData($startTime = '',$endTime = ''){
        $aSql = 'SELECT `th`.*,`users`.money AS `userMoney`,`level`.third_rebate FROM 
                    (SELECT `third_rebate`.game_id,`third_rebate`.game_name,`third_rebate`.user_id,`third_rebate`.user_account,`third_rebate`.user_name,
                    `third_rebate`.agent_account,`third_rebate`.agent_name,`third_rebate`.agent_id,`third_rebate`.general_account,
                    `third_rebate`.general_name,`third_rebate`.general_id,SUM(`third_rebate`.money) AS `money` 
                    FROM `third_rebate` WHERE `date` >= :startTime AND `date` <= :endTime GROUP BY `game_id`,`user_id`) AS `th`
                    JOIN `users` ON `users`.id = `th`.user_id
                    JOIN `level` ON `level`.value = `users`.rechLevel';
        $aArray = [
            'startTime' => $startTime,
            'endTime' => $endTime,
        ];
        return DB::select($aSql,$aArray);
    }

    public static function agentReportData($startTime = '',$endTime = ''){
        $aSql = 'SELECT `th`.*,`games_list`.pid FROM 
                    (
                        SELECT  `game_id`,`game_name`,`agent_account`,`agent_name`,`agent_id`,
                        `general_account`,`general_name`,`general_id`,SUM(`money`) AS `money` 
                        FROM `third_rebate` WHERE `updated_at` >= :startTime AND `updated_at` <= :endTime AND `status` IN(1,3) 
                        GROUP BY `game_id`,`agent_id`
                    ) AS `th`
                    JOIN `games_list` ON `games_list`.game_id = `th`.game_id';
        $aArray = [
            'startTime' => $startTime,
            'endTime' => $endTime,
        ];
        return DB::select($aSql,$aArray);
    }

    public static function generalReportData($startTime = '',$endTime = ''){
        $aSql = 'SELECT `th`.*,`games_list`.pid FROM 
                    (
                        SELECT  `game_id`,`game_name`,`general_account`,`general_name`,`general_id`,SUM(`money`) AS `money` 
                        FROM `third_rebate` WHERE `updated_at` >= :startTime AND `updated_at` <= :endTime AND `status` IN(1,3) 
                        GROUP BY `game_id`,`general_id`
                    ) AS `th`
                    JOIN `games_list` ON `games_list`.game_id = `th`.game_id';
        $aArray = [
            'startTime' => $startTime,
            'endTime' => $endTime,
        ];
        return DB::select($aSql,$aArray);
    }

    public static function memberReportData($startTime = '',$endTime = ''){
        $aSql = 'SELECT `th`.*,`games_list`.pid FROM 
                    (
                        SELECT  `game_id`,`game_name`,`agent_account`,`agent_name`,`agent_id`,`general_account`,
                        `general_name`,`general_id`,`user_id`,`user_account`,`user_name`,SUM(`money`) AS `money` 
                        FROM `third_rebate` WHERE `updated_at` >= :startTime AND `updated_at` <= :endTime AND `status` IN(1,3) 
                        GROUP BY `game_id`,`user_id`
                    ) AS `th`
                    JOIN `games_list` ON `games_list`.game_id = `th`.game_id';
        $aArray = [
            'startTime' => $startTime,
            'endTime' => $endTime,
        ];
        return DB::select($aSql,$aArray);
    }
}
