<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $table = 'feedback';
    protected $primaryKey = 'id';

    public static $role = [
        'type' => 'required|integer',
        'content' => 'required|string',
        'user_id' => 'required|integer',
        'user_name' => 'required|string|max:50',
        'user_account' => 'required|integer|max:50',
        'status' => 'required|integer',
    ];

    public static $feedbackType = [
        '1' => '充值问题',
        '2' => '提款问题',
        '3' => '其他问题',
        '4' => '提交建议',
        '5' => '我要申诉',
    ];

    public static $feedbackStatus = [
        '1' => '未回复',
        '2' => '已回复',
    ];

    //获取单挑反馈信息
    public static function getFeedbackInfoOne($id){
        $data = self::where('id','=',$id)->first();
        $data->typeName = self::$feedbackType[$data->type];
        return $data;
    }
}
