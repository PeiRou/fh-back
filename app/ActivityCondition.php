<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActivityCondition extends Model
{
    protected $table = 'activity_condition';
    protected $primaryKey = 'id';

    public static $role = [
        'activity_id' => 'required|integer',
        'day' => 'required|integer',
        'money' => 'required|numeric',
        'total_money' => 'required|numeric',
        'bet' => 'required|integer',
        'bonus' => 'required|array',
        'award' => 'required|array',
        'num' => 'required|array',
        'ranking' => 'required|array',
    ];

    //获取详情
    public static function getDetailInfoOne($id){
        $data = self::
            select('activity_condition.*', 'activity.type')
            ->where('activity_condition.id','=',$id)
            ->leftJoin('activity', 'activity.id', 'activity_condition.activity_id')
            ->first();
        $data->content = json_decode($data->content,true);
        return $data;
    }

//    //获取所有活动数据多表的,
//    public static function condition ($param = null)
//    {
//        //直接放数组里
//        $table = [
//            static::getConditionSql($param),
//            \App\ActivityConditionHongbao::getConditionSql($param)
//        ];
//        $where = '';
//        if(isset($param->activity_id))
//            $where .= ' AND `activity_condition`.`activity_id` = '.(int)$param->activity_id.' ';
//        $sql = "SELECT activity_condition.*, `activity`.`name` FROM ( ".implode(' UNION ALL ', $table)." ) as activity_condition
//        	INNER JOIN `activity` ON `activity`.`id` = `activity_condition`.`activity_id`
//        	WHERE 1 {$where}
//        	ORDER BY activity_condition.activity_id asc , activity_condition.day asc ";
//        return \Illuminate\Support\Facades\DB::select($sql);
//    }
//
//    public static function getConditionSql ($param)
//    {
//        return "SELECT
//				`activity_condition`.`activity_id`,
//				`activity_condition`.`id`,
//				`activity_condition`.`day`,
//				`activity_condition`.`money`,
//				`activity_condition`.`bet`,
//				`activity_condition`.`total_money`
//			FROM
//				`activity_condition`";
//    }

}
