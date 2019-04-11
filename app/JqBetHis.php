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
                    `jq`.`name` AS `user_name`,`jq`.`user_id` AS `user_id`,`jq`.`username` AS `user_account`,
                     `jq`.`a_id` AS `agent_id`,`jq`.`agent_account` AS `agent_account`,`jq`.`agent_name` AS `agent_name`,
                     `games_api`.`g_id` AS `game_id`, `games_api`.`name` AS `game_name` 
                     FROM 
                        (SELECT `g_id`,`user_id`,`username`,'' AS `name`,`agent` AS `a_id`,`agent_account`,`agent_name`,
                            COUNT(`id`) AS `bet_count`,SUM(`bunko`) AS `bet_bunko`,SUM(`bet_money`) AS `bet_money`
                            FROM `jq_bet_his` WHERE `updated_at` >= :startTime AND `updated_at` <= :endTime GROUP BY `user_id`,`g_id`
                            ) AS `jq`
                    JOIN `games_api` ON `games_api`.`g_id` = `jq`.`g_id`";
        $aArray = [
            'startTime' => $startTime,
            'endTime' => $endTime,
        ];
        return DB::select($aSql,$aArray);
    }
}