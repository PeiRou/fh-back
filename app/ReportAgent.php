<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ReportAgent extends Model
{
    protected $table = 'report_agent';
    protected $primaryKey = 'id';

    public static function reportQuery($aParam){
        $aSql = "SELECT SUM(`fact_bet_bunko`) AS `fact_bet_bunko`,SUM(`bet_count`) AS `bet_count`,SUM(`bet_money`) AS `bet_money`,
                  SUM(`recharges_money`) AS `recharges_money`,SUM(`drawing_money`) AS `drawing_money`,SUM(`activity_money`) AS `activity_money`,
                  SUM(`handling_fee`) AS `handling_fee`,SUM(`bet_amount`) AS `bet_amount`,SUM(`bet_bunko`) AS `bet_bunko`,
                  SUM(`odds_amount`) AS `odds_amount`,SUM(`return_amount`) AS `return_amount`,SUM(`fact_return_amount`) AS `fact_return_amount`,
                  `agent_account`,`agent_name`,`agent_id`
                  FROM `report_agent` WHERE 1 ";
        $result = self::conditionalConnection($aSql,$aParam);
        $aSql = $result['aSql']." LIMIT ".$aParam['start'].",".$aParam['length'];
        $bSql = "SELECT COUNT(`agent_id`) AS `memberCount`,`agent_id` FROM `report_member` WHERE 1 ";
        $bParam = [
            'timeStart' => $aParam['timeStart'],
            'timeEnd' => $aParam['timeEnd'],
            'chkTest' => 1
        ];
        $resultB = ReportMember::conditionalConnection($bSql,$bParam,0);
        $bSql = $resultB['aSql']." GROUP BY `agent_id`";
        $aSql = "SELECT `sum`.*,`count`.`memberCount` FROM (".$aSql.") AS `sum` JOIN (".$bSql.") AS `count` ON `count`.`agent_id` = `sum`.`agent_id`";
        return DB::select($aSql,array_merge($result['aArray'],$resultB['aArray']));
    }

    public static function reportQueryCount($aParam){
        $aSql = "SELECT `agent_id` FROM `report_agent` WHERE 1 ";
        $result = self::conditionalConnection($aSql,$aParam);
        $aSql = "SELECT COUNT(`a`.`agent_id`) AS `count` FROM ( ".$result['aSql']." ) AS `a`";
        return DB::select($aSql,$result['aArray'])[0]->count;
    }

    public static function reportQuerySum($aParam){
        $aSql = "SELECT SUM(`fact_bet_bunko`) AS `fact_bet_bunko`,SUM(`bet_count`) AS `bet_count`,SUM(`bet_money`) AS `bet_money`,
                  SUM(`recharges_money`) AS `recharges_money`,SUM(`drawing_money`) AS `drawing_money`,SUM(`activity_money`) AS `activity_money`,
                  SUM(`handling_fee`) AS `handling_fee`,SUM(`bet_amount`) AS `bet_amount`,SUM(`bet_bunko`) AS `bet_bunko`
                  FROM `report_agent` WHERE 1 ";
        $result = self::conditionalConnection($aSql,$aParam,0);
        return DB::select($result['aSql'],$result['aArray'])[0];
    }

    public static function conditionalConnection($aSql,$aParam,$group = 1){
        $aArray = [];
        if(isset($aParam['timeStart']) && array_key_exists('timeStart',$aParam)){
            $aSql .= " AND `dateTime` >= :startTimeA";
            $aArray['startTimeA'] = strtotime($aParam['timeStart']);
        }
        if(isset($aParam['timeEnd']) && array_key_exists('timeEnd',$aParam)){
            $aSql .= " AND `dateTime` <= :endTimeA";
            $aArray['endTimeA'] = strtotime($aParam['timeEnd'].' 23:59:59');
        }
        if(isset($aParam['account']) && array_key_exists('account',$aParam)){
            $aSql .= " AND `agent_account` = :userAccount";
            $aArray['userAccount'] = $aParam['account'];
        }
        if($group === 1){
            $aSql .= " GROUP BY `agent_id`";
        }
        return [
            'aSql' => $aSql,
            'aArray' => $aArray
        ];
    }
}
