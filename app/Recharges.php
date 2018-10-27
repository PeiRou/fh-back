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

    public static function getOnlineMemberToday($date){
        $aSql = "SELECT COUNT(`re`.`userId`) AS `count` FROM 
                  (SELECT `userId` FROM `recharges` JOIN `users` ON `users`.`id` = `recharges`.`userId` 
                    WHERE `users`.`testFlag` = 0 AND `recharges`.`payType` = 'onlinePayment' AND `recharges`.`status` = 2 
                    AND `recharges`.`created_at` >= :startTime 
                    AND `recharges`.`created_at` <= :endTime 
                    GROUP BY `recharges`.`userId`) AS `re`";
        $aArray = [
            'startTime' => $date,
            'endTime' => $date.' 23:59:59'
        ];
        return DB::select($aSql,$aArray)[0]->count;
    }

    public static function getOfflineMemberToday($date){
        $aSql = "SELECT COUNT(`re`.`userId`) AS `count` FROM 
                  (SELECT `userId` FROM `recharges` JOIN `users` ON `users`.`id` = `recharges`.`userId` 
                    WHERE `users`.`testFlag` = 0 AND `recharges`.`payType` IN('alipay','bankTransfer','cft','weixin') AND `recharges`.`status` = 2 
                    AND `recharges`.`created_at` >= :startTime 
                    AND `recharges`.`created_at` <= :endTime 
                    GROUP BY `recharges`.`userId`) AS `re`";
        $aArray = [
            'startTime' => $date,
            'endTime' => $date.' 23:59:59'
        ];
        return DB::select($aSql,$aArray)[0]->count;
    }

    //导出会员数据
    public static function exportExcelForRecharges($request){
        $findUserId = '';
        $killTestUser = $request->get('killTestUser');
        $payType = $request->get('recharge_type');
        $startTime = $request->get('startTime');
        $endTime = $request->get('endTime');
        $account_type = $request->get('account_type');
        $account_param = $request->get('account_param');
        $status = $request->get('status');
        $pay_online_id = $request->get('pay_online_id');
        $amount = $request->get('amount');
        $fullName = $request->get('fullName');
        if($fullName && isset($fullName)){
            $findUserId = DB::table('users')->where('fullName',$fullName)->first();
        }

        $sql = ' from recharges JOIN users on recharges.userId = users.id LEFT JOIN level on level.value = recharges.levels WHERE 1 ';
        $where = '';
        if(isset($killTestUser) && $killTestUser){
            $where .= ' and users.testFlag = 0 ';
        }else{
            $where .= ' and users.testFlag in (0,2) ';
        }
        if(isset($pay_online_id) && empty($pay_online_id)){
            $where .= ' and recharges.pay_online_id = '.$pay_online_id;
        }
        if(isset($amount) && $amount){
            $where .= ' and recharges.amount = '.$amount;
        }
        if(isset($findUserId) && $findUserId){
            $where .= ' and recharges.userId = '.$findUserId->id;
        }
        if(isset($account_param) && $account_param){
            if($account_type == 'account'){
                $where .= " and recharges.username = '".$account_param."'";
            }else if($account_type == 'orderNum'){
                $where .= " and recharges.orderNum = '".$account_param."'";
            }else if($account_type == 'operation_account'){
                $where .= " and recharges.operation_account = '".$account_param."'";
            }else if($account_type == 'sysOrderNum'){
                $where .= " and recharges.sysPayOrder = '".$account_param."'";
            }
        }
        if(isset($startTime) && $startTime){
            $where .= " and recharges.created_at >= '".$startTime." 00:00:00'";
        }
        if(isset($endTime) && $endTime){
            $where .= " and recharges.created_at <= '".$endTime." 23:59:59'";
        }
        if(empty($startTime) && empty($endTime))
            $where .= " and recharges.created_at = now() ";
//        $whereStaus = '';

        if(empty($findUserId) && empty($account_param)){
            if(isset($status) && $status){
                $whereStaus = ' and recharges.status = '.$status;
            }else{
                $whereStaus = ' and recharges.status in (1,2,3)';
            }
            if(isset($payType) && $payType){
                $where .= " and recharges.payType = '".$payType."'";
            }else{
                $where .= " and recharges.payType in ('bankTransfer' , 'alipay', 'weixin', 'cft')";
            }
        }else{
            if(isset($status) && $status){
                $whereStaus = ' and recharges.status = '.$status;
            }else{
                $whereStaus = ' and recharges.status in (1,2,3,4)';
            }
        }
        $sql1 = 'SELECT users.username as username,recharges.amount as amount,recharges.operation_account as operation_account,recharges.shou_info as shou_info,recharges.status as re_status '.$sql.$where .$whereStaus. ' order by recharges.created_at desc ';
        return DB::select($sql1);
    }
}
