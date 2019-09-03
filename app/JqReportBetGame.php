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
}