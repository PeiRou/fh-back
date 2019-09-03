<?php

namespace App\Http\Controllers\Back;

use App\Drawing;
use App\Feedback;
use App\Recharges;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Session;

class AjaxStatusController extends Controller
{
    public function status()
    {
        $sessionId = Session::get('account_session_id');
        $saId = Session::get('account_id');
        $key = 'sa:'.md5($saId);
        $timeOutKey = 'adminTimeOut:'.md5($saId);
        $redis = Redis::connection();
        $redis->select(4);
        $timeOut = $redis->get($timeOutKey);
        $timeOut = $timeOut + 60 * 60 * 2;
        if($redis->exists($key) && $timeOut > time() ){
            $session_Id = (array)json_decode($redis->get($key),true);
            if($session_Id['session_id'] != $sessionId){
                Session::flush();
                return response()->json([
                    'status'=>false,
                    'msg'=>'您的账号已在异地登录，此账号现已强制下线！'
                ]);
            }
            $redisData = [
                'session_id' => (string)Session::get('account_session_id'),
                'sa_id' => (string)$saId
            ];
            $jsonEncode = json_encode($redisData);
            $redis->setex($key,600,$jsonEncode);     //重新赋予后台登陆时间

            $getCount = Recharges::where('status',1)->where('payType','!=','onlinePayment')->count();
            $getDrawCount = Drawing::where('status',0)->count();

            $todayTime = date('Y-m-d');
            $feedbackCount = Feedback::where('status','=',1)->whereBetween('created_at',[$todayTime,$todayTime.' 23:59:59'])->count();

            $redis->select(6);           //前台
            $keys = $redis->keys('urtime:'.'*');
            $onlineUserCount = 0;                   //会员在线人数
            $onlineUserCount_and = 0;               //安卓-会员在线人数
            $onlineUserCount_pc = 0;                //PC-会员在线人数
            $onlineUserCount_ios = 0;               //IOS-会员在线人数
            $onlineUserCount_m = 0;                 //M-会员在线人数
            foreach ($keys as $item){
                $redis->select(6);           //前台
                $redisUser = $redis->get($item);
                $redisUser = (array)json_decode($redisUser,true);
                $redis->select(2);
                $redisUser['user_id'] = isset($redisUser['user_id'])?$redisUser['user_id']:'';
                $keyUser = 'user:'.md5($redisUser['user_id']);
                if(empty($redisUser['user_id']) || !$redis->exists($keyUser)){
                    $redis->select(6);
                    $redis->del($item);
                }else{
                    $redisUser = $redis->get($keyUser);
                    $redisUser = (array)json_decode($redisUser,true);
                    if(!empty($redisUser))
                        if($redisUser['testFlag']==0){
                            switch (@$redisUser['platform']){
                                case 1:
                                    $onlineUserCount_pc ++;
                                    break;
                                case 3:
                                    $onlineUserCount_ios ++;
                                    break;
                                case 4:
                                    $onlineUserCount_and ++;
                                    break;
                                default:
                                    $onlineUserCount_m ++;
                                    break;
                            }
                            $onlineUserCount++;
                        }
                }
            }

            $redis->select(4);           //后台
//            $onlineAdminCount = Redis::dbsize();
            $keys = $redis->keys('sa:'.'*');
            $onlineAdminCount = count($keys);
            if(Redis::exists('sa:'.md5(1)))    $onlineAdminCount--;
            return response()->json([
                'status' => true,
                'count' => $getCount,
                'drawCount' => $getDrawCount,
                'onlineUser' => $onlineUserCount,
                'onlineUserPC' => $onlineUserCount_pc,
                'onlineUserM' => $onlineUserCount_m,
                'onlineUserIOS' => $onlineUserCount_ios,
                'onlineUserAND' => $onlineUserCount_and,
                'onlineAdmin' => $onlineAdminCount,
                'feedbackCount' => $feedbackCount,
                'offerCount' => \App\Repository\OfferRepository::offerCount(),//快到期的平台费用数量 数据表还没更新 暂时注释
            ]);
        }else{
            Session::flush();
            return response()->json([
                'status'=>false,
                'msg'=>'您的账号存在异常，请重新登录'
            ]);
        }
    }
}
