<?php


namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class JqReportBetGame extends Model
{
    protected $table = 'jq_report_bet_game';

    protected $primaryKey = 'id';

    //获取列表
    public static function reportQuerySum($aParam = [])
    {
        $where = ' ';
        if(isset($aParam['startTime'], $aParam['endTime'])){
            $where .= " AND `date` BETWEEN :startTime AND :endTime ";
        }
        $sql = "SELECT
                    `game_id`, `game_name`, SUM(`bet_bunko`) AS `bet_bunko`, `productType`
                FROM
                    `jq_report_bet_game`
                WHERE 1 {$where}
                GROUP BY
                    `game_id`,
                IF ( `game_id` = 19, `productType`, NULL )";
        return DB::select($sql, $aParam);
    }

    //获取代理棋牌投注
    public static function betAgentReportData($startTime = '',$endTime = ''){
        $aSql = "SELECT SUM(`bet_count`) AS `bet_count`,SUM(`bet_bunko`) AS `bet_bunko`,`agent_id`,`game_id`,`game_name` 
                    FROM `jq_report_bet_game` WHERE 1";
        $aArray = [];
        if(!empty($startTime)){
            $aSql .= " `date` >= :startTime";
            $aArray['startTime'] = $startTime;
        }
        if(!empty($endTime)){
            $aSql .= " `date` >= :endTime";
            $aArray['endTime'] = $endTime;
        }
        $aSql .= " GROUP BY `agent_id`,`game_id`";
        return DB::select($aSql,$aArray);
    }

    //获取总代理棋牌投注
    public static function betGeneralReportData(){
        $aSql = "SELECT SUM(`jq_report_bet_game`.`bet_count`) AS `bet_count`,SUM(`jq_report_bet_game`.`bet_bunko`) AS `bet_bunko`,
                     `jq_report_bet_game`.`game_id`,`jq_report_bet_game`.`game_name`,`agent`.`gagent_id`
                    FROM `jq_report_bet_game` 
                    JOIN `agent` ON `agent`.a_id = `jq_report_bet_game`.agent_id
                    WHERE 1";
        $aArray = [];
        if(!empty($startTime)){
            $aSql .= " `jq_report_bet_game`.`date` >= :startTime";
            $aArray['startTime'] = $startTime;
        }
        if(!empty($endTime)){
            $aSql .= " `jq_report_bet_game`.`date` >= :endTime";
            $aArray['endTime'] = $endTime;
        }
        $aSql .= " GROUP BY `agent`.`gagent_id`,`jq_report_bet_game`.`game_id`";
        return DB::select($aSql,$aArray);
    }
}