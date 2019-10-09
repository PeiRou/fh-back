<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PromotionRecode extends Model
{
    protected $table = 'promotion_record';

    protected $primaryKey = 'id';

    public static function betMemberReportData($startTime = '',$endTime = ''){
        $aSql = 'SELECT `promotion_user_id`,`game_id`,`user_id`,SUM(`money`) AS `money` FROM `promotion_record` 
                    WHERE `date` >= :startTime AND `date` <= :endTime GROUP BY `game_id`,`user_id`,`promotion_user_id`';
        $aArray = [
            'startTime' => $startTime,
            'endTime' => $endTime,
        ];
        return DB::select($aSql,$aArray);
    }

    public static function agentReportData($startTime = '',$endTime = ''){
        $aSql = 'SELECT `pro`.*,`games_list`.pid FROM 
                    (
                        SELECT `game_id`,`game_name`,`agent_account`,`agent_name`,`agent_id`,
                        `general_account`,`general_name`,`general_id`,SUM(`money`) AS `money` FROM `promotion_record`
                        WHERE `updated_at` >= :startTime AND `updated_at` <= :endTime AND `status` IN(1,3) AND `receive_status` IN(1,3)
                        GROUP BY `game_id`,`agent_id`
                    ) AS `pro`
                    JOIN `games_list` ON `games_list`.game_id = `pro`.game_id';
        $aArray = [
            'startTime' => $startTime,
            'endTime' => $endTime,
        ];
        return DB::select($aSql,$aArray);
    }

    public static function generalReportData($startTime = '',$endTime = ''){
        $aSql = 'SELECT `pro`.*,`games_list`.pid FROM 
                    (
                        SELECT `game_id`,`game_name`,
                        `general_account`,`general_name`,`general_id`,SUM(`money`) AS `money` FROM `promotion_record`
                        WHERE `updated_at` >= :startTime AND `updated_at` <= :endTime AND `status` IN(1,3) AND `receive_status` IN(1,3)
                        GROUP BY `game_id`,`general_id`
                    ) AS `pro`
                    JOIN `games_list` ON `games_list`.game_id = `pro`.game_id';
        $aArray = [
            'startTime' => $startTime,
            'endTime' => $endTime,
        ];
        return DB::select($aSql,$aArray);
    }

    public static function memberReportData($startTime = '',$endTime = ''){
        $aSql = 'SELECT `pro`.*,`games_list`.pid FROM 
                    (
                        SELECT `game_name`,`agent_account`,`agent_name`,`agent_id`,`game_id`,`user_id`,`user_account`,`user_name`,
                        `general_account`,`general_name`,`general_id`,SUM(`money`) AS `money` FROM `promotion_record`
                        WHERE `updated_at` >= :startTime AND `updated_at` <= :endTime AND `status` IN(1,3) AND `receive_status` IN(1,3)
                        GROUP BY `game_id`,`user_id`
                    ) AS `pro`
                    JOIN `games_list` ON `games_list`.game_id = `pro`.game_id';
        $aArray = [
            'startTime' => $startTime,
            'endTime' => $endTime,
        ];
        return DB::select($aSql,$aArray);
    }
}
