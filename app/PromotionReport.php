<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PromotionReport extends Model
{
    protected $table = 'promotion_report';
    protected $primaryKey = 'id';

    public static $role = [
        'bet_money' => 'required',
        'fenhong_prop' => 'required',
        'commission' => 'required',
    ];

    public static $reportStatus = [
        '0' => '未结算',
        '1' => '已结算',
        '2' => '审核中',
        '3' => '驳回',
        '4' => '结算过期',
    ];

    //获取推广结算数据
    public static function promotionBillingData($date){
        $aSql = 'SELECT SUM(betCount) AS `betCount`,SUM(`betMoneySum`) AS `betMoneySum`,`agent_id`,`user_id`,`promotion_id`,`account`,`name`
                    FROM (SELECT COUNT(`bet`.`bet_id`) AS `betCount`,SUM(`bet`.`bunko`) AS `betMoneySum`,`bet`.`agent_id`,`bet`.`user_id`,`bet`.`promotion_id`,`agent`.`account`,`agent`.`name` 
                      FROM `bet` JOIN `agent` ON `agent`.`a_id` = `bet`.`agent_id` 
                      WHERE `bet`.`promotion_id` != 0 AND bet.`updated_at` BETWEEN :startTime AND :endTime
                      GROUP BY `bet`.`promotion_id`,`bet`.`agent_id`,`bet`.`user_id` HAVING `betMoneySum` < 0) AS `betGroup`
                    GROUP BY `promotion_id`,`agent_id`';
        $sqlArray = ['startTime'=>$date['start'],'endTime'=>$date['end']];
        return DB::select($aSql,$sqlArray);
    }

    //获取单挑信息
    public static function promotionInfoOne($id){
        return self::where('id','=',$id)->first();
    }

}
