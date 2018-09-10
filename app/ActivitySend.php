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

    public function getDataByTime($time){
        return $this->select('activity_send.created_at','activity_send.updated_at','activity_send.user_id','activity_send.user_name','activity_send.user_account','activity_send.prize_id','activity_send.prize_name','activity_send.activity_id','activity_send.activity_name','activity_send.status','activity_sign_record.day','activity_sign_record.continue_days','activity.type')
            ->whereBetween('activity_send.created_at',[$time,$time." 23:59:59"])
            ->join('activity','activity.id','=','activity_send.activity_id')
            ->leftJoin('activity_sign_record','activity_sign_record.send_id','=','activity_send.id')
            ->orderBy('activity_send.created_at','desc')->get();
    }
}
