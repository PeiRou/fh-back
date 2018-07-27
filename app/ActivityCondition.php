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
        $data = self::where('id','=',$id)->first();
        $data->content = json_decode($data->content,true);
        return $data;
    }
}
