<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActivitySend extends Model
{
    protected $table = 'activity_send';
    protected $primaryKey = 'id';

    //活动状态
    public static $activityStatus = [
        '1' => '未中奖',
        '2' => '未审核',
        '3' => '审核不通过',
        '4' => '审核通过',
        '5' => '已领取',
    ];

    //表单验证
    public static $role = [
        'user_id' => 'required|integer',
        'user_name' => 'required|string|max:50',
        'user_account' => 'required|string|max:50',
        'prize_id' => 'required|integer',
        'prize_name' => 'required|string|max:50',
        'activity_id' => 'required|integer',
        'activity_name' => 'required|string|max:50',
    ];
}
