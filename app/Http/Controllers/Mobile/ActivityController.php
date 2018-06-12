<?php

namespace App\Http\Controllers\Mobile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ActivityController extends Controller
{
    public function homeActivity()
    {
        $activity1 = [
            'activityDesc' => '连续充值抽奖活动↵↵活动内容：↵1.所有玩家只需每天登录游戏，存款以及投注量达到对应要求，即可参与！ 2.如果中间间断一天，连续签到将被重置开始时间隔天计算。 3.活动统计时间为：北京时间当天04:30-隔天04:30↵活动时',
            'activityType' => 1,
            'beginAt' => "2017-09-23 00:00:00",
            'endAt' => "2018-12-31 23:59:59",
            'id' => 80,
            'isOpen' => 1,
            'topActivityId' => 80,
            'continuousTimes' => 1,
            'name'=>'连续充值签到抽奖活动'
        ];
        $activity2 = [
            'activityDesc' => '登陆抽奖活动↵↵活动内容：↵1、每日可进行抽奖1次； 2、需要您在抽奖的前一天有过下注记录才可抽奖，中奖率高达85%。',
            'activityType' => 3,
            'beginAt' => "2017-09-23 00:00:00",
            'endAt' => "2018-12-31 23:59:59",
            'continuousTimes' => null,
            'id' => 82,
            'isOpen' => 1,
            'topActivityId' => 82,
            'name'=>'登陆抽奖活动'
        ];
        $act = [$activity1,$activity2];
        return response()->json($act);
    }

    public function getUserActivityList(Request $request)
    {
        $topActivityId = $request->topActivityId;
        return [];
    }

    public function getTodayUserActivity(Request $request)
    {
        return response()->json([
            'activityId' => null,
            'activitySort' => null,
            'activityType' => null,
            'createdAt' => null,
            'id' => null,
            'joinStatus' => null,
            'rewardType' => null,
            'statDay' => null,
            'topActivityId'=> null,
            'updatedAt' => null,
            'userId' => null,
            'userName' => null
        ]);
    }
}
