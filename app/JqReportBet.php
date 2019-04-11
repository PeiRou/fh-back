<?php


namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class JqReportBet extends Model
{
    protected $table = 'jq_report_bet';

    protected $primaryKey = 'id';

    public static function reportQuerySelect($aParam){
        $aSql = "SELECT `user_id` FROM `jq_report_bet` WHERE 1 ";
        $aArray = [
            'start' => $aParam['start'],
            'length' => $aParam['length']
        ];
        if(isset($aParam['user_account']) && array_key_exists('user_account',$aParam)){
            $aSql .= " AND `user_account` = :user_account ";
            $aArray['user_account'] = $aParam['user_account'];
        }
        if(isset($aParam['agent_account']) && array_key_exists('agent_account',$aParam)){
            $aSql .= " AND `agent_account` = :agent_account ";
            $aArray['agent_account'] = $aParam['agent_account'];
        }
        if(isset($aParam['startTime']) && array_key_exists('startTime',$aParam)){
            $aSql .= " AND `date` >= :startTime ";
            $aArray['startTime'] = $aParam['startTime'];
        }
        if(isset($aParam['endTime']) && array_key_exists('endTime',$aParam)){
            $aSql .= " AND `date` <= :endTime ";
            $aArray['endTime'] = $aParam['endTime'].' 23:59:59';
        }
        $aSql .= " GROUP BY `user_id` ORDER BY `user_id` ASC LIMIT :start,:length";
        $aUserId = DB::select($aSql,$aArray);
        $aData = [];
        foreach ($aUserId as $iUserId){
            $aData[] = $iUserId->user_id;
        }
        return $aData;
    }

    public static function reportQuery($userId,$aParam){
        $aSql = "SELECT `game_name`,`agent_account`,`agent_name`,`user_account`,`user_name`,`user_id`,`game_id`, 
                    SUM(`up_fraction`) AS `up_fraction`,SUM(`down_fraction`) AS `down_fraction`,SUM(`bet_bunko`) AS `bet_bunko`,SUM(`bet_money`) AS `bet_money`
                    FROM `jq_report_bet` WHERE 1 ";
        $aArray = [];
        if(empty($userId))
            $aSql .= "AND `user_id` = 0";
        else
            $aSql .= "AND `user_id` IN (".$userId.")";
        if(isset($aParam['startTime']) && array_key_exists('startTime',$aParam)){
            $aSql .= " AND `date` >= :startTime ";
            $aArray['startTime'] = $aParam['startTime'];
        }
        if(isset($aParam['endTime']) && array_key_exists('endTime',$aParam)){
            $aSql .= " AND `date` <= :endTime ";
            $aArray['endTime'] = $aParam['endTime'].' 23:59:59';
        }
        $aSql .= " GROUP BY `user_id`,`game_id`";
        return DB::select($aSql,$aArray);
    }

    public static function reportQueryCount($aParam){
        $aSql = "SELECT COUNT(`jq`.`user_id`) AS `count` FROM (SELECT `user_id` FROM `jq_report_bet` WHERE 1 ";
        $aArray = [];
        if(isset($aParam['user_account']) && array_key_exists('user_account',$aParam)){
            $aSql .= " AND `user_account` = :user_account ";
            $aArray['user_account'] = $aParam['user_account'];
        }
        if(isset($aParam['agent_account']) && array_key_exists('agent_account',$aParam)){
            $aSql .= " AND `agent_account` = :agent_account ";
            $aArray['agent_account'] = $aParam['agent_account'];
        }
        if(isset($aParam['startTime']) && array_key_exists('startTime',$aParam)){
            $aSql .= " AND `date` >= :startTime ";
            $aArray['startTime'] = $aParam['startTime'];
        }
        if(isset($aParam['endTime']) && array_key_exists('endTime',$aParam)){
            $aSql .= " AND `date` <= :endTime ";
            $aArray['endTime'] = $aParam['endTime'].' 23:59:59';
        }
        $aSql .= " GROUP BY `user_id`) AS `jq`";
        return DB::select($aSql,$aArray)[0]->count;
    }

    public static function reportQuerySum($aParam){
        $aSql = "SELECT SUM(`up_fraction`) AS `up_fraction`,SUM(`down_fraction`) AS `down_fraction`,SUM(`bet_bunko`) AS `bet_bunko`,SUM(`bet_money`) AS `bet_money`,`game_id` FROM `jq_report_bet` WHERE 1";
        $aArray = [];
        if(isset($aParam['user_account']) && array_key_exists('user_account',$aParam)){
            $aSql .= " AND `user_account` = :user_account ";
            $aArray['user_account'] = $aParam['user_account'];
        }
        if(isset($aParam['agent_account']) && array_key_exists('agent_account',$aParam)){
            $aSql .= " AND `agent_account` = :agent_account ";
            $aArray['agent_account'] = $aParam['agent_account'];
        }
        if(isset($aParam['startTime']) && array_key_exists('startTime',$aParam)){
            $aSql .= " AND `date` >= :startTime ";
            $aArray['startTime'] = $aParam['startTime'];
        }
        if(isset($aParam['endTime']) && array_key_exists('endTime',$aParam)){
            $aSql .= " AND `date` <= :endTime ";
            $aArray['endTime'] = $aParam['endTime'].' 23:59:59';
        }
        $aSql .= " GROUP BY `game_id`";
        return DB::select($aSql,$aArray);
    }

    public static function excelQuery($aParam){
        $aSql = "SELECT `game_name`,`agent_account`,`agent_name`,`user_account`,`user_name`,`user_id`,`game_id`, 
                    SUM(`bet_count`) AS `bet_count`,SUM(`bet_money`) AS `bet_money`,SUM(`bet_bunko`) AS `bet_bunko`
                    FROM `jq_report_bet` WHERE 1 ";
        $aArray = [];
        if(isset($aParam['user_account']) && array_key_exists('user_account',$aParam)){
            $aSql .= " AND `user_account` = :user_account ";
            $aArray['user_account'] = $aParam['user_account'];
        }
        if(isset($aParam['agent_account']) && array_key_exists('agent_account',$aParam)){
            $aSql .= " AND `agent_account` = :agent_account ";
            $aArray['agent_account'] = $aParam['agent_account'];
        }
        if(isset($aParam['startTime']) && array_key_exists('startTime',$aParam)){
            $aSql .= " AND `date` >= :startTime ";
            $aArray['startTime'] = $aParam['startTime'];
        }
        if(isset($aParam['endTime']) && array_key_exists('endTime',$aParam)){
            $aSql .= " AND `date` <= :endTime ";
            $aArray['endTime'] = $aParam['endTime'].' 23:59:59';
        }
        $aSql .= " GROUP BY `user_id`,`game_id` ORDER BY `user_id`";
        return DB::select($aSql,$aArray);
    }

}