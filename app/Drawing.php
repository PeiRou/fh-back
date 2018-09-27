<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Drawing extends Model
{
    protected $table = 'drawing';

    public static function AssemblyFundDetails($param,$status = ''){
        $aSql = self::select('drawing.username','drawing.user_id','drawing.order_id','drawing.created_at',DB::raw("(CASE WHEN drawing.status = 3 THEN 't17' ELSE 't15' END) AS type"),'drawing.amount as money','drawing.balance',DB::raw("'' as issue,'' as game_id,'' as game_name,'' as play_type"),'drawing.operation_id','drawing.operation_account','drawing.msg',DB::raw("'' as content2,'' as freeze_money,'' as unfreeze_money,'' as nn_view_money,drawing.amount as c_money,'' as bet_id,'' as rechargesType"))
            ->where(function ($aSql) use($param,$status){
                if(isset($param['startTime']) && array_key_exists('startTime',$param) && isset($param['endTime']) && array_key_exists('endTime',$param)){
                    $aSql->whereBetween('drawing.created_at',[date("Y-m-d 00:00:00",strtotime($param['startTime'])),date("Y-m-d 23:59:59",strtotime($param['endTime']))]);
                }else{
                    if(isset($param['time_point']) && array_key_exists('time_point',$param)) {
                        if($param['time_point'] == 'today'){
                            $time = date('Y-m-d');
                            $aSql->whereBetween('drawing.created_at', [$time . ' 00:00:00', $time . ' 23:59:59']);
                        }elseif($param['time_point'] == 'yesterday'){
                            $time = date('Y-m-d',strtotime('- 1 day',time()));
                            $aSql->whereBetween('drawing.created_at', [$time . ' 00:00:00', $time . ' 23:59:59']);
                        }else{
                            $time = date('Y-m-d',strtotime('- 2 day',time()));
                            $aSql->whereBetween('drawing.created_at', [$time . ' 00:00:00', $time . ' 23:59:59']);
                        }
                    }
                }
                if(isset($param['account_id']) && array_key_exists('account_id',$param)){
                    $aSql->where('drawing.user_id','=',$param['account_id']);
                }
                if(isset($param['account']) && array_key_exists('account',$param)){
                    $aSql->where('drawing.username','=',$param['account']);
                }
                if(isset($param['order_id']) && array_key_exists('order_id',$param)){
                    $aSql->where('drawing.order_id','=',$param['order_id']);
                }
                if(isset($param['amount_min']) && array_key_exists('amount_min',$param)){
                    $aSql->where('drawing.amount','>=',$param['amount_min']);
                }
                if(isset($param['amount_max']) && array_key_exists('amount_max',$param)){
                    $aSql->where('drawing.amount','<=',$param['amount_max']);
                }
                if(!empty($status)){
                    if($status === 't17'){
                        $aSql->where('drawing.status','=',3);
                    }else{
                        $aSql->whereIn('drawing.status',[0,1,2,4]);
                    }
                }
            });
        return $aSql;
    }

    public static function getDailyStatistics($dayTime){
        return self::select(DB::raw("'user_id','COUNT(id) AS idCount','SUM(amount)' AS amountSum"))
            ->where('status',2)->whereBetween('created_at',[$dayTime,$dayTime.' 23:59:59'])
            ->groupBy('user_id')->get();
    }

    public static function betMemberReportData($startTime = '',$endTime = ''){
        $aSql = "SELECT `user_id`,SUM(`amount`) AS `drAmountSum`,LEFT(`created_at`,10) AS `date` FROM `drawing` WHERE `status` = 2 ";
        $aArray = [];
        if(!empty($startTime)){
            $aSql .= " AND `created_at` >= :startTime ";
            $aArray['startTime'] = $startTime;
        }
        if(!empty($endTime)){
            $aSql .= " AND `created_at` <= :endTime ";
            $aArray['endTime'] = $endTime;
        }
        $aSql .= " GROUP BY `user_id`,`date` ORDER BY `date` ASC";
        return DB::select($aSql,$aArray);
    }

    public static function betAgentReportData($startTime = '',$endTime = ''){
        $aSql = "SELECT `users`.`agent` AS `agentId`,LEFT(`drawing`.`created_at`,10) AS `date`,SUM(`drawing`.`amount`) AS `drAmountSum`,COUNT(DISTINCT(`users`.`id`)) AS `userIdCount`
                  FROM `drawing`
                  JOIN `users` ON `users`.`id` = `drawing`.`user_id`
                  WHERE `drawing`.`status` = 2 AND `users`.`testFlag` = 0 ";
        $aArray = [];
        if(!empty($startTime)){
            $aSql .= " AND `drawing`.`created_at` >= :startTime ";
            $aArray['startTime'] = $startTime;
        }
        if(!empty($endTime)){
            $aSql .= " AND `drawing`.`created_at` <= :endTime ";
            $aArray['endTime'] = $endTime;
        }
        $aSql .= " GROUP BY `agentId`,`date` ORDER BY `date` ASC";
        return DB::select($aSql,$aArray);
    }

    public static function betGeneralReportData($startTime = '',$endTime = ''){
        $aSql = "SELECT `agent`.`gagent_id` AS `generalId`,LEFT(`drawing`.`created_at`,10) AS `date`,SUM(`drawing`.`amount`) AS `drAmountSum`,
                  COUNT(DISTINCT(`users`.`id`)) AS `userIdCount`,COUNT(DISTINCT(`agent`.`a_id`)) AS `agentIdCount`
                  FROM `drawing`
                  JOIN `users` ON `users`.`id` = `drawing`.`user_id`
                  JOIN `agent` ON `agent`.`a_id` = `users`.`agent`
                  WHERE `drawing`.`status` = 2 AND `users`.`testFlag` = 0 ";
        $aArray = [];
        if(!empty($startTime)){
            $aSql .= " AND `drawing`.`created_at` >= :startTime ";
            $aArray['startTime'] = $startTime;
        }
        if(!empty($endTime)){
            $aSql .= " AND `drawing`.`created_at` <= :endTime ";
            $aArray['endTime'] = $endTime;
        }
        $aSql .= " GROUP BY `generalId`,`date` ORDER BY `date` ASC";
        return DB::select($aSql,$aArray);
    }
}
