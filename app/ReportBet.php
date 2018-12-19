<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ReportBet extends Model
{
    protected $table = 'report_bet';

    public static function reportQuery($aParam){
        $iJoin = ' LEFT JOIN ';
        if(isset($aParam['killZeroBetGame']) && $aParam['killZeroBetGame']){        //过滤零投注彩种
            $iJoin = " JOIN ";
        }
        $aSql = "SELECT `game`.game_name,`game`.status,`game`.game_id,
                  `report`.countMember,`report`.countWinBunkoMember,
                  `report`.sumMoney,`report`.countBets,`report`.sumWinBunko,`report`.countWinBunkoBet,
                  (CASE WHEN `report`.`sumBunko` IS NULL THEN 0 ELSE `report`.`sumBunko` END) AS `sumBunko` 
                  FROM `game`
                  ".$iJoin." (
                        SELECT SUM(`bet_money`) AS `sumMoney`,SUM(`bet_count`) AS `countBets`,SUM(`win_bunko`) AS `sumWinBunko`,
                            COUNT(DISTINCT(`user_id`)) AS `countMember`,
                            COUNT(DISTINCT(CASE WHEN `win_count` > 0 THEN `user_id` ELSE NULL END)) AS `countWinBunkoMember`,
                            SUM(`win_count`) AS `countWinBunkoBet`,SUM(`bunko`) AS `sumBunko`,`game_id` 
                        FROM `report_bet` WHERE `date` >= :startReportTime AND `date` <= :endReportTime 
                        GROUP BY `game_id`
                        ) AS `report` ON `report`.game_id = `game`.game_id ";
        $aArray = [
            'startReportTime' => $aParam['startTime'],
            'endReportTime' => $aParam['endTime'] . ' 23:59:59',
        ];
        if(isset($aParam['killCloseGame']) && $aParam['killCloseGame']){        //过滤未开启彩种
            $aSql .= " WHERE game.status = 1 ";
        }
        $aSql .= " ORDER BY `sumBunko` ASC";
        return DB::select($aSql,$aArray);
    }
}
