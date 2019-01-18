<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Activity extends Model
{
    protected $table = 'activity';
    protected $primaryKey = 'id';

    //活动类型
    public static $activityType = [
        '1' => '每天登陆活动',
        '2' => '连续性活动',
//        '3' => '红包活动'
    ];

    //活动状态
    public static $activityStatus = [
        '1' => '正常',
        '2' => '关闭',
    ];

    //表单验证
    public static $role = [
        'name' => 'required|max:100',
        'type' => 'required|integer',
        'start_time' => 'required|date',
        'end_time' => 'required|date',
    ];

    public static function betMemberReportData($startTime = '',$endTime = ''){
        $aSql = "SELECT SUM(CASE WHEN `type` = 't08' THEN `money` ELSE 0 END ) AS `sumActivity`,SUM(CASE WHEN `type` = 't04' THEN `money` ELSE 0 END ) AS `sumRecharge_fee`,
                  `to_user`,SUM(`money`) AS `moneySum`,LEFT(`created_at`,10) AS `date` FROM `capital` 
                  WHERE `type` IN('t08','t04') ";
        $aArray = [];
        if(!empty($startTime)){
            $aSql .= " AND `created_at` >= :startTime ";
            $aArray['startTime'] = $startTime;
        }
        if(!empty($endTime)){
            $aSql .= " AND `created_at` <= :endTime ";
            $aArray['endTime'] = $endTime;
        }
        $aSql .= " GROUP BY `to_user`,`date` ORDER BY `date` ASC";
        return DB::select($aSql,$aArray);
    }
}
