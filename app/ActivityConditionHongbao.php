<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActivityConditionHongbao extends Model
{
    protected $table = 'activity_condition_hongbao';
    protected $primaryKey = 'id';

    public static $role = [
        'activity_id' => 'required|integer',
        'money' => 'required|numeric',
        'total_money1' => 'required|numeric',
//        'bet' => 'required|integer',
    ];

    //获取详情
    public static function getDetailInfoOne($id){
        $data = self::where('id','=',$id)->first();
        return $data;
    }
//
//    public static function getConditionSql ($param)
//    {
//        return "SELECT
//				`activity_condition_hongbao`.`activity_id`,
//				`activity_condition_hongbao`.`id`,
//				1 AS `day`,
//				`activity_condition_hongbao`.`money`,
//				`activity_condition_hongbao`.`bet`,
//				`activity_condition_hongbao`.`total_money`
//			FROM `activity_condition_hongbao`";
//    }

}
