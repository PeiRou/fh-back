<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ReportMember extends Model
{
    protected $table = 'report_member';
    protected $primaryKey = 'id';

    public static function reportQuery($aParam){
        $aSql = "SELECT `user_id`,`user_account`,user_name AS user_name,`agent_id`, 
                  SUM(`bet_count`) AS `bet_count`,SUM(`bet_money`) AS `bet_money`,`agent_account`,SUM(`bet_amount`) AS `bet_amount`,
                  SUM(`fact_bet_bunko`) AS `fact_bet_bunko`,SUM(`bet_bunko`) AS `bet_bunko`,
                  SUM(`odds_amount`) AS `odds_amount`,SUM(`return_amount`) AS `return_amount`,SUM(`fact_return_amount`) AS `fact_return_amount`,
                  SUM(`activity_money`) AS `activity_money`,SUM(`handling_fee`) AS `handling_fee`,
                  SUM(`drawing_money`) AS `drawing_money`,SUM(`recharges_money`) AS `recharges_money`
                  FROM `report_member` WHERE 1 ";
        $result = self::conditionalConnection($aSql,$aParam);
        $result['aSql'] .= " ORDER BY `fact_bet_bunko` ASC ";
        isset($aParam['start'], $aParam['length']) && $result['aSql'] .= "LIMIT ".$aParam['start'].",".$aParam['length'];

        return DB::select($result['aSql'],$result['aArray']);
    }

    public static function reportQuerySql($aParam){
        $aSql = "SELECT `user_id`,`user_account`,`user_name`,`agent_id`, 
                  `bet_count` AS `bet_count`,`bet_money` AS `bet_money`,`agent_account`,`bet_amount` AS `bet_amount`,
                  `fact_bet_bunko` AS `fact_bet_bunko`,`bet_bunko` AS `bet_bunko`,
                  `odds_amount` AS `odds_amount`,`return_amount` AS `return_amount`,`fact_return_amount` AS `fact_return_amount`,
                  `activity_money` AS `activity_money`,`handling_fee` AS `handling_fee`,
                  `drawing_money` AS `drawing_money`,`recharges_money` AS `recharges_money`
                  FROM `report_member` WHERE 1 ";
        $result1 = self::conditionalConnection($aSql,$aParam,0);
        $aParam['timeStart'] = $aParam['timeEnd'] = date('Y-m-d');
        $result2 = Bets::UserTodaySql($aParam);
        $aSql = "SELECT `user_id`,`user_account`,`user_name`,`agent_id`, 
                  SUM(`bet_count`) AS `bet_count`,SUM(`bet_money`) AS `bet_money`,`agent_account`,SUM(`bet_amount`) AS `bet_amount`,
                  SUM(`fact_bet_bunko`) AS `fact_bet_bunko`,SUM(`bet_bunko`) AS `bet_bunko`,
                  SUM(`odds_amount`) AS `odds_amount`,SUM(`return_amount`) AS `return_amount`,SUM(`fact_return_amount`) AS `fact_return_amount`,
                  SUM(`activity_money`) AS `activity_money`,SUM(`handling_fee`) AS `handling_fee`,
                  SUM(`drawing_money`) AS `drawing_money`,SUM(`recharges_money`) AS `recharges_money` FROM (".$result1['aSql'].' UNION '.$result2.") AS `report`
                   GROUP BY `user_id` HAVING 1 ORDER BY `fact_bet_bunko` ASC LIMIT ".$aParam['start'].",".$aParam['length'];
//        var_dump($aSql,$result1['aArray']);die();
        return DB::select($aSql,$result1['aArray']);
    }

    public static function reportQueryCount($aParam){
        $aSql = "SELECT `user_id`,SUM(`fact_bet_bunko`) AS `fact_bet_bunko` FROM `report_member` WHERE 1 ";
        $result = self::conditionalConnection($aSql,$aParam);
        $aSql = "SELECT COUNT(`a`.`user_id`) AS `count` FROM ( ".$result['aSql']." ) AS `a`";
        return DB::select($aSql,$result['aArray'])[0]->count;
    }

    public static function reportQueryCountSql($aParam){
        $aSql = "SELECT `user_id`,`user_account`,`user_name`,`agent_id`, 
                  `bet_count` AS `bet_count`,`bet_money` AS `bet_money`,`agent_account`,`bet_amount` AS `bet_amount`,
                  `fact_bet_bunko` AS `fact_bet_bunko`,`bet_bunko` AS `bet_bunko`,
                  `odds_amount` AS `odds_amount`,`return_amount` AS `return_amount`,`fact_return_amount` AS `fact_return_amount`,
                  `activity_money` AS `activity_money`,`handling_fee` AS `handling_fee`,
                  `drawing_money` AS `drawing_money`,`recharges_money` AS `recharges_money`
                  FROM `report_member` WHERE 1 ";
        $result1 = self::conditionalConnection($aSql,$aParam,0);
        $aParam['timeStart'] = $aParam['timeEnd'] = date('Y-m-d');
        $result2 = Bets::UserTodaySql($aParam);
        $aSql = "SELECT `user_id` FROM (".$result1['aSql'].' UNION '.$result2.") AS `report` GROUP BY `user_id`";
        $aSql = "SELECT COUNT(`a`.`user_id`) AS `count` FROM ( ".$aSql." ) AS `a`";
        return DB::select($aSql,$result1['aArray'])[0]->count;
    }

    public static function reportQuerySum($aParam){
        $aSql = "SELECT SUM(`fact_bet_bunko`) AS `fact_bet_bunko`,
                  COUNT(distinct `user_id`) AS count_user,
                  COUNT(distinct `agent_account`) AS count_agent,
                  SUM(`bet_count`) AS `bet_count`,SUM(`bet_money`) AS `bet_money`,
                  SUM(`recharges_money`) AS `recharges_money`,SUM(`drawing_money`) AS `drawing_money`,SUM(`activity_money`) AS `activity_money`,
                  SUM(`handling_fee`) AS `handling_fee`,SUM(`bet_amount`) AS `bet_amount`,SUM(`bet_bunko`) AS `bet_bunko`,
                  SUM(`fact_return_amount`) as fact_return_amount
                  FROM `report_member` WHERE 1 ";
        $result = self::conditionalConnection($aSql,$aParam,0);
        return DB::select($result['aSql'],$result['aArray'])[0];
    }

    public static function reportQuerySumSql($aParam){
        $aSql = "SELECT `user_id`,`user_account`,`user_name`,`agent_id`, 
                  `bet_count` AS `bet_count`,`bet_money` AS `bet_money`,`agent_account`,`bet_amount` AS `bet_amount`,
                  `fact_bet_bunko` AS `fact_bet_bunko`,`bet_bunko` AS `bet_bunko`,
                  `odds_amount` AS `odds_amount`,`return_amount` AS `return_amount`,`fact_return_amount` AS `fact_return_amount`,
                  `activity_money` AS `activity_money`,`handling_fee` AS `handling_fee`,
                  `drawing_money` AS `drawing_money`,`recharges_money` AS `recharges_money`
                  FROM `report_member` WHERE 1 ";
        $result1 = self::conditionalConnection($aSql,$aParam,0);
        $aParam['timeStart'] = $aParam['timeEnd'] = date('Y-m-d');
        $result2 = Bets::UserTodaySql($aParam);
        $aSql = "SELECT `user_id`,`user_account`,`user_name`,`agent_id`, 
                  SUM(`bet_count`) AS `bet_count`,SUM(`bet_money`) AS `bet_money`,`agent_account`,SUM(`bet_amount`) AS `bet_amount`,
                  SUM(`fact_bet_bunko`) AS `fact_bet_bunko`,SUM(`bet_bunko`) AS `bet_bunko`,
                  SUM(`odds_amount`) AS `odds_amount`,SUM(`return_amount`) AS `return_amount`,SUM(`fact_return_amount`) AS `fact_return_amount`,
                  SUM(`activity_money`) AS `activity_money`,SUM(`handling_fee`) AS `handling_fee`,
                  SUM(`drawing_money`) AS `drawing_money`,SUM(`recharges_money`) AS `recharges_money` FROM (".$result1['aSql'].' UNION '.$result2.") AS `report`";
        return DB::select($aSql,$result1['aArray'])[0];
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
        if(isset($aParam['agent_id']) && array_key_exists('agent_id',$aParam)){
            $aSql .= " AND `agent_id` = :agentIdM";
            $aArray['agentIdM'] = $aParam['agent_id'];
        }
        if(isset($aParam['general_id']) && array_key_exists('general_id',$aParam)){
            $aSql .= " AND `general_id` = :generalIdM";
            $aArray['generalIdM'] = $aParam['general_id'];
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
