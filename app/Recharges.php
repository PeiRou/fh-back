<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Recharges extends Model
{
    protected $table = 'recharges';

    public static $rechargesType = [
        '1' => '加彩金',
        '2' => '掉单补发',
        '3' => '其他'
    ];

    public static function getDailyStatistics($dayTime){
        return self::select(DB::raw("'userId','SUM(amount) AS amountSum','COUNT(id) AS idCount'"))->where('status',2)
            ->whereBetween('created_at',[$dayTime,$dayTime.' 23:59:59'])
            ->groupBy('userId')
            ->get();
    }

    public static function betMemberReportData($startTime = '',$endTime = ''){
        $aSql = "SELECT `userId`,SUM(`amount`) AS `reAmountSum`,LEFT(`created_at`,10) AS `date` FROM `recharges` WHERE `status` = 2 AND payType != 'adminAddMoney'";
        $aArray = [];
        if(!empty($startTime)){
            $aSql .= " AND `created_at` >= :startTime ";
            $aArray['startTime'] = $startTime;
        }
        if(!empty($endTime)){
            $aSql .= " AND `created_at` <= :endTime ";
            $aArray['endTime'] = $endTime;
        }
        $aSql .= " GROUP BY `userId`,`date` ORDER BY `date` ASC";
        return DB::select($aSql,$aArray);
    }

    public static function betAgentReportData($startTime = '',$endTime = ''){
        $aSql = "SELECT LEFT(`recharges`.`created_at`,10) AS `date`,SUM(`recharges`.`amount`) AS `reAmountSum`,`users`.`agent` AS `agentId`,COUNT(DISTINCT(`users`.`id`)) AS `userIdCount`
                  FROM `recharges`
                  JOIN `users` ON `users`.`id` = `recharges`.`userId`
                  WHERE `recharges`.`status` = 2 AND `recharges`.`payType` != 'adminAddMoney' AND `users`.`testFlag` = 0 ";
        $aArray = [];
        if(!empty($startTime)){
            $aSql .= " AND `recharges`.`created_at` >= :startTime ";
            $aArray['startTime'] = $startTime;
        }
        if(!empty($endTime)){
            $aSql .= " AND `recharges`.`created_at` <= :endTime ";
            $aArray['endTime'] = $endTime;
        }
        $aSql .= " GROUP BY `agentId`,`date` ORDER BY `date` ASC";
        return DB::select($aSql,$aArray);
    }

    public static function betGeneralReportData($startTime = '',$endTime = ''){
        $aSql = "SELECT LEFT(`recharges`.`created_at`,10) AS `date`,SUM(`recharges`.`amount`) AS `reAmountSum`,`agent`.`gagent_id` AS `generalId`,
                  COUNT(DISTINCT(`users`.`id`)) AS `userIdCount`,COUNT(DISTINCT(`agent`.`a_id`)) AS `agentIdCount`
                  FROM `recharges`
                  JOIN `users` ON `users`.`id` = `recharges`.`userId`
                  JOIN `agent` ON `agent`.`a_id` = `users`.`agent`
                  WHERE `recharges`.`status` = 2 AND `recharges`.`payType` != 'adminAddMoney' AND `users`.`testFlag` = 0 ";
        $aArray = [];
        if(!empty($startTime)){
            $aSql .= " AND `recharges`.`created_at` >= :startTime ";
            $aArray['startTime'] = $startTime;
        }
        if(!empty($endTime)){
            $aSql .= " AND `recharges`.`created_at` <= :endTime ";
            $aArray['endTime'] = $endTime;
        }
        $aSql .= " GROUP BY `generalId`,`date` ORDER BY `date` ASC";
        return DB::select($aSql,$aArray);
    }
}
