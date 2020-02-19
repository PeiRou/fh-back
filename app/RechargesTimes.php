<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RechargesTimes extends Model
{
    protected $table = 'recharges_times';

    //获取首充用户
    public static function getFirstChargeUsersCount($date){
        return self::where('recharges_times.frequency',1)
            ->join('users', 'users.id','=','recharges_times.userId')
            ->join('recharges', 'recharges.id','=','recharges_times.rechargesId')
            ->where('users.testFlag',0)
            ->whereBetween('recharges_times.created_at',[$date,$date.' 23:59:59'])
            ->count();
    }

    //获取首充金额
    public static function getFirstChargeUsersMoney($date){
        return self::where('recharges_times.frequency',1)
            ->join('users', 'users.id','=','recharges_times.userId')
            ->join('recharges', 'recharges.id','=','recharges_times.rechargesId')
            ->where('users.testFlag',0)
            ->whereBetween('recharges_times.created_at',[$date,$date.' 23:59:59'])
            ->sum('recharges.amount');
    }

    //获取第二次充值用户
    public static function getSecondChargeUsersCount($date){
        return self::where('recharges_times.frequency',2)
            ->join('users', 'users.id','=','recharges_times.userId')
            ->where('users.testFlag',0)
            ->whereBetween('recharges_times.created_at',[$date,$date.' 23:59:59'])->count();
    }

    //获取第三次充值用户
    public static function getThirdChargeUsersCount($date){
        return self::where('recharges_times.frequency',3)
            ->join('users', 'users.id','=','recharges_times.userId')
            ->where('users.testFlag',0)
            ->whereBetween('recharges_times.created_at',[$date,$date.' 23:59:59'])->count();
    }
}