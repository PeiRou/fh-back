<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ReportRecharge extends Model
{
    protected $table = 'report_recharge';

    public static function getReportRechargeData($aParam){
        return self::where(function ($aSql) use($aParam){
            if(isset($aParam['startTime']) && array_key_exists('startTime',$aParam))
                $aSql->where('date','>=',$aParam['startTime']);
            if(isset($aParam['endTime']) && array_key_exists('endTime',$aParam))
                $aSql->where('date','<=',$aParam['endTime'].' 23:59:59');
        })->skip($aParam['start'])->take($aParam['length'])->orderBy('date','desc')->get();
    }

    public static function getReportRechargeCount($aParam){
        return self::where(function ($aSql) use($aParam){
            if(isset($aParam['startTime']) && array_key_exists('startTime',$aParam))
                $aSql->where('date','>=',$aParam['startTime']);
            if(isset($aParam['endTime']) && array_key_exists('endTime',$aParam))
                $aSql->where('date','<=',$aParam['endTime'].' 23:59:59');
        })->count();
    }

    public static function getReportRechargeTotal($aParam){
        return self::select(DB::raw("SUM(`register_person`) AS `RegisterPerson`,SUM(`register_member`) AS `RegisterMember`,SUM(`register_agent`) AS `RegisterAgent`,SUM(`recharge_first`) AS `RechargeFirst`,SUM(`recharge_second`) AS `RechargeSecond`,SUM(`current_count`) AS `CurrentCount`,SUM(`current_money`) AS `CurrentMoney`"))
            ->where(function ($aSql) use($aParam){
                if(isset($aParam['startTime']) && array_key_exists('startTime',$aParam))
                    $aSql->where('date','>=',$aParam['startTime']);
                if(isset($aParam['endTime']) && array_key_exists('endTime',$aParam))
                    $aSql->where('date','<=',$aParam['endTime'].' 23:59:59');
            })->get();
    }
}
