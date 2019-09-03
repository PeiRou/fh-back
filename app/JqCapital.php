<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class JqCapital extends Model
{
    protected $table = 'jq_capital';

    protected $primaryKey = 'id';

    public static function jqReportData($startTime,$endTime){
        $aSql = "SELECT `jq`.`up_amount`,`jq`.`down_amount`,
                    `jq`.`name` AS `user_name`,`jq`.`userid` AS `userid`,`jq`.`username` AS `user_account`,
                     `jq`.`agent` AS `agent_id`,`jq`.`agent_account` AS `agent_account`,`jq`.`agent_name` AS `agent_name`,
                     `games_api`.`g_id` AS `game_id`, `games_api`.`name` AS `game_name`
                    FROM 
                        (SELECT `userid`,`g_id`,SUM(CASE WHEN `type` = 1 THEN `amount` ELSE 0 END) AS `up_amount`,
                            SUM(CASE WHEN `type` = 2 THEN `amount` ELSE 0 END) AS `down_amount`,
                            `username`,`agent`,`agent_account`,`agent_name`,'' AS `name` FROM `jq_capital`
                            WHERE `date` >= :startTime AND `date` <= :endTime AND `testFlag` = 0  GROUP BY `userid`,`g_id`) AS `jq`
                    JOIN `games_api` ON `games_api`.`g_id` = `jq`.`g_id`";
        $aArray = [
            'startTime' => $startTime,
            'endTime' => $endTime,
        ];
        return DB::select($aSql,$aArray);
    }

}
