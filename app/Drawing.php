<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Drawing extends Model
{
    protected $table = 'drawing';

    public static $statusDrawing = [
        0 => '未受理',
        1 => '处理中',
        2 => '通过',
        3 => '不通过',
        4 => '锁定',
    ];

    public static function AssemblyFundDetails($param,$status = ''){
        $aSql = self::select('drawing.username','drawing.user_id','drawing.order_id','drawing.updated_at',DB::raw("(CASE WHEN drawing.status = 3 THEN 't17' ELSE 't15' END) AS type"),'drawing.amount as money','drawing.balance',DB::raw("'' as issue,'' as game_id,'' as game_name,'' as play_type"),'drawing.operation_id','drawing.operation_account','drawing.msg',DB::raw("'' as content2,'' as freeze_money,'' as unfreeze_money,'' as nn_view_money,drawing.amount as c_money,'' as bet_id,'' as rechargesType"))
            ->where(function ($aSql) use($param,$status){
                if(isset($param['startTime']) && array_key_exists('startTime',$param) && isset($param['endTime']) && array_key_exists('endTime',$param)){
                    $aSql->whereBetween('drawing.updated_at',[date("Y-m-d 00:00:00",strtotime($param['startTime'])),date("Y-m-d 23:59:59",strtotime($param['endTime']))]);
                }else{
                    if(isset($param['time_point']) && array_key_exists('time_point',$param)) {
                        if($param['time_point'] == 'today'){
                            $time = date('Y-m-d');
                            $aSql->whereBetween('drawing.updated_at', [$time . ' 00:00:00', $time . ' 23:59:59']);
                        }elseif($param['time_point'] == 'yesterday'){
                            $time = date('Y-m-d',strtotime('- 1 day',time()));
                            $aSql->whereBetween('drawing.updated_at', [$time . ' 00:00:00', $time . ' 23:59:59']);
                        }else{
                            $time = date('Y-m-d',strtotime('- 2 day',time()));
                            $aSql->whereBetween('drawing.updated_at', [$time . ' 00:00:00', $time . ' 23:59:59']);
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
        $aSql = "SELECT `user_id`,SUM(`amount`) AS `drAmountSum`,LEFT(`updated_at`,10) AS `date` FROM `drawing` WHERE `status` = 2  AND `draw_type` IN(0,1) ";
        $aArray = [];
        if(!empty($startTime)){
            $aSql .= " AND `updated_at` >= :startTime ";
            $aArray['startTime'] = $startTime;
        }
        if(!empty($endTime)){
            $aSql .= " AND `updated_at` <= :endTime ";
            $aArray['endTime'] = $endTime;
        }
        $aSql .= " GROUP BY `user_id`,`date` ORDER BY `date` ASC";
        return DB::select($aSql,$aArray);
    }

    public static function betAgentReportData($startTime = '',$endTime = ''){
        $aSql = "SELECT `users`.`agent` AS `agentId`,LEFT(`drawing`.`updated_at`,10) AS `date`,SUM(`drawing`.`amount`) AS `drAmountSum`,COUNT(DISTINCT(`users`.`id`)) AS `userIdCount`
                  FROM `drawing`
                  JOIN `users` ON `users`.`id` = `drawing`.`user_id`
                  WHERE `drawing`.`status` = 2 AND `drawing`.`draw_type` IN(0,1) AND `users`.`testFlag` = 0 ";
        $aArray = [];
        if(!empty($startTime)){
            $aSql .= " AND `drawing`.`updated_at` >= :startTime ";
            $aArray['startTime'] = $startTime;
        }
        if(!empty($endTime)){
            $aSql .= " AND `drawing`.`updated_at` <= :endTime ";
            $aArray['endTime'] = $endTime;
        }
        $aSql .= " GROUP BY `agentId`,`date` ORDER BY `date` ASC";
        return DB::select($aSql,$aArray);
    }

    public static function betGeneralReportData($startTime = '',$endTime = ''){
        $aSql = "SELECT `agent`.`gagent_id` AS `generalId`,LEFT(`drawing`.`updated_at`,10) AS `date`,SUM(`drawing`.`amount`) AS `drAmountSum`,
                  COUNT(DISTINCT(`users`.`id`)) AS `userIdCount`,COUNT(DISTINCT(`agent`.`a_id`)) AS `agentIdCount`
                  FROM `drawing`
                  JOIN `users` ON `users`.`id` = `drawing`.`user_id`
                  JOIN `agent` ON `agent`.`a_id` = `users`.`agent`
                  WHERE `drawing`.`status` = 2 AND `drawing`.`draw_type` IN(0,1) AND `users`.`testFlag` = 0 ";
        $aArray = [];
        if(!empty($startTime)){
            $aSql .= " AND `drawing`.`updated_at` >= :startTime ";
            $aArray['startTime'] = $startTime;
        }
        if(!empty($endTime)){
            $aSql .= " AND `drawing`.`updated_at` <= :endTime ";
            $aArray['endTime'] = $endTime;
        }
        $aSql .= " GROUP BY `generalId`,`date` ORDER BY `date` ASC";
        return DB::select($aSql,$aArray);
    }

    public static function drawingRecord($aParam){
        return self::select('drawing.created_at as dr_created_at','drawing.bank_name as dr_bank_name','drawing.fullName as dr_fullName','drawing.bank_num as dr_bank_num','drawing.bank_addr as dr_bank_addr','drawing.process_date as dr_process_date','users.rechLevel as user_rechLevel','drawing.user_id as dr_uid','drawing.amount as dr_amount','users.fullName as user_fullName','users.bank_name as user_bank_name','users.bank_num as user_bank_num','users.bank_addr as user_bank_addr','drawing.fullName as draw_fullName','drawing.levels as levels','drawing.bank_name as draw_bank_name','drawing.bank_num as draw_bank_num','drawing.bank_addr as draw_bank_addr','drawing.ip_info as dr_ip_info','drawing.ip as dr_ip','drawing.draw_type as dr_draw_type','drawing.status as dr_status','drawing.msg as dr_msg','drawing.platform as dr_platform','drawing.id as dr_id','users.username as user_username','drawing.balance as dr_balance','drawing.order_id as dr_order_id','drawing.operation_account as dr_operation_account','level.name as level_name','users.DrawTimes as user_DrawTimes','drawing.total_bet as dr_total_bet')
            ->leftJoin('users','drawing.user_id', '=', 'users.id')
            ->leftJoin('level','drawing.levels', '=', 'level.value')
            ->where(function ($q) use ($aParam){
                if(isset($aParam['killTestUser']) && array_key_exists('killTestUser',$aParam)){
                    $q->where('users.agent','!=',2);
                }
            })
            ->where(function ($q) use ($aParam){
                if(isset($aParam['status']) && array_key_exists('status',$aParam)){
                    if($aParam['status'] == 'no'){
                        $q->where('drawing.status',0);
                    } else {
                        $q->where('drawing.status',$aParam['status']);
                    }
                }
            })
            ->where(function ($q) use ($aParam){
                if(isset($aParam['draw_type']) && array_key_exists('draw_type',$aParam)){
                    $q->where('drawing.draw_type',$aParam['draw_type']);
                }
            })
            ->where(function ($q) use ($aParam){
                if(isset($aParam['rechLevel']) && array_key_exists('rechLevel',$aParam)){
                    $q->where('users.rechLevel',$aParam['rechLevel']);
                }
            })
            ->where(function ($q) use ($aParam){
                if(isset($aParam['account_param']) && array_key_exists('account_param',$aParam)){
                    if($aParam['account_type'] == 'account'){
                        $q->where('drawing.username',$aParam['account_param']);
                    }
                    if($aParam['account_type'] == 'orderNum'){
                        $q->where('drawing.order_id',$aParam['account_param']);
                    }
                    if($aParam['account_type'] == 'operation_account'){
                        $q->where('drawing.operation_account',$aParam['account_param']);
                    }
                    if($aParam['account_type'] == 'amount'){
                        $q->where('drawing.amount',$aParam['account_param']);
                    }
                }
            })
            ->where(function ($q) use ($aParam) {
                if(isset($aParam['startTime']) && array_key_exists('startTime',$aParam) || isset($aParam['endTime']) && array_key_exists('endTime',$aParam)){
                    $q->whereBetween('drawing.created_at',[$aParam['startTime'].' 00:00:00', $aParam['endTime'].' 23:59:59']);
                } else {
                    $q->whereDate('drawing.created_at',date('Y-m-d'));
                }
            })
            ->orderBy('drawing.created_at','desc')->get();
    }
}
