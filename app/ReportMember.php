<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ReportMember extends Model
{
    protected $table = 'report_member';
    protected $primaryKey = 'id';

    public static function reportQuery($aParam){
        $aSql = "SELECT SUM(`fact_bet_bunko`) AS `fact_bet_bunko`,SUM(`bet_count`) AS `bet_count`,SUM(`bet_money`) AS `bet_money`,
                  SUM(`recharges_money`) AS `recharges_money`,SUM(`drawing_money`) AS `drawing_money`,SUM(`activity_money`) AS `activity_money`,
                  SUM(`handling_fee`) AS `handling_fee`,SUM(`bet_amount`) AS `bet_amount`,SUM(`bet_bunko`) AS `bet_bunko`,
                  SUM(`odds_amount`) AS `odds_amount`,SUM(`return_amount`) AS `return_amount`,SUM(`fact_return_amount`) AS `fact_return_amount`,
                  `user_account`,`user_name`,`user_id`,`agent_account` 
                  FROM `report_member` WHERE 1 ";
        $result = self::conditionalConnection($aSql,$aParam);
        $result['aSql'] .= " ORDER BY `fact_bet_bunko` ASC LIMIT ".$aParam['start'].",".$aParam['length'];
        return DB::select($result['aSql'],$result['aArray']);
    }

    public static function reportQueryCount($aParam){
        $aSql = "SELECT `user_id`,SUM(`fact_bet_bunko`) AS `fact_bet_bunko` FROM `report_member` WHERE 1 ";
        $result = self::conditionalConnection($aSql,$aParam);
        $aSql = "SELECT COUNT(`a`.`user_id`) AS `count` FROM ( ".$result['aSql']." ) AS `a`";
        return DB::select($aSql,$result['aArray'])[0]->count;
    }

    public static function reportQuerySum($aParam){
        $aSql = "SELECT SUM(`fact_bet_bunko`) AS `fact_bet_bunko`,SUM(`bet_count`) AS `bet_count`,SUM(`bet_money`) AS `bet_money`,
                  SUM(`recharges_money`) AS `recharges_money`,SUM(`drawing_money`) AS `drawing_money`,SUM(`activity_money`) AS `activity_money`,
                  SUM(`handling_fee`) AS `handling_fee`,SUM(`bet_amount`) AS `bet_amount`,SUM(`bet_bunko`) AS `bet_bunko`
                  FROM `report_member` WHERE 1 ";
        $result = self::conditionalConnection($aSql,$aParam,0);
        return DB::select($result['aSql'],$result['aArray'])[0];
    }

    public static function conditionalConnection($aSql,$aParam,$group = 1){
        $aArray = [];
        if(isset($aParam['timeStart']) && array_key_exists('timeStart',$aParam)){
            $aSql .= " AND `dateTime` >= :startTimeM";
            $aArray['startTimeM'] = strtotime($aParam['timeStart']);
        }
        if(isset($aParam['timeEnd']) && array_key_exists('timeEnd',$aParam)){
            $aSql .= " AND `dateTime` <= :endTimeM";
            $aArray['endTimeM'] = strtotime($aParam['timeEnd'].' 23:59:59');
        }
        if(isset($aParam['account']) && array_key_exists('account',$aParam)){
            $aSql .= " AND `user_account` = :userAccount";
            $aArray['userAccount'] = $aParam['account'];
        }
        if(isset($aParam['chkTest']) && array_key_exists('chkTest',$aParam)){
            if($aParam['chkTest'] == 1){
                $aSql .= " AND `user_test_flag` = 0";
            }

        }
        if($group === 1){
            $aSql .= " GROUP BY `user_id` HAVING 1";
            if(isset($aParam['minBunko']) && array_key_exists('minBunko',$aParam) && isset($aParam['maxBunko']) && array_key_exists('maxBunko',$aParam)){
                if(isset($aParam['minBunko']) && array_key_exists('minBunko',$aParam)){
                    $aSql .= " AND `fact_bet_bunko` >= :minBunko";
                    $aArray['minBunko'] = $aParam['minBunko'];
                }
                if(isset($aParam['maxBunko']) && array_key_exists('maxBunko',$aParam)){
                    $aSql .= " AND `fact_bet_bunko` >= :maxBunko";
                    $aArray['maxBunko'] = $aParam['maxBunko'];
                }
            }
        }
        return [
            'aSql' => $aSql,
            'aArray' => $aArray
        ];
    }
}
