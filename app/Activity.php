<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $table = 'activity';
    protected $primaryKey = 'id';

    //活动类型
    public static $activityType = [
        '1' => '每天登陆活动',
        '2' => '连续性活动',
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
}
