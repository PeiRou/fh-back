<?php


namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class JqBetHis extends Model
{
    protected $table = 'jq_bet_his';

    protected $primaryKey = 'id';

    public static function jqReportData($startTime,$endTime){
        $aSql = "SELECT `jq`.`bet_money`,`jq`.`bet_bunko`,`jq`.`bet_count`,
                    `users`.`name` AS `user_name`,`users`.`id` AS `user_id`,`users`.`username` AS `user_account`,
                     `agent`.`a_id` AS `agent_id`,`agent`.`account` AS `agent_account`,`agent`.`name` AS `agent_name`,
                     `games_api`.`g_id` AS `game_id`, `games_api`.`name` AS `game_name`
                     FROM 
                        (SELECT `g_id`,`user_id`,SUM(`AllBet`) AS `bet_money`,SUM(`bunko`) AS `bet_bunko`,SUM(`bet_money`) AS `bet_count`
                            FROM `jq_bet_his` WHERE `updated_at` >= :startTime AND `updated_at` <= :endTime GROUP BY `user_id`,`g_id`
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
}