<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RechargesTimes extends Model
{
    protected $table = 'recharges_times';

    //获取首充用户
    public static function getFirstChargeUsersCount($date){
        return self::where('frequency',1)->whereBetween('created_at',[$date,$date.' 23:59:59'])->count();
    }

    //获取第二次充值用户
    public static function getSecondChargeUsersCount($date){
        return self::where('frequency',2)->whereBetween('created_at',[$date,$date.' 23:59:59'])->count();
    }

    //获取第三次充值用户
    public static function getThirdChargeUsersCount($date){
        return self::where('frequency',3)->whereBetween('created_at',[$date,$date.' 23:59:59'])->count();
    }
}