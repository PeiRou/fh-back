<?php

namespace App\Http\Controllers\Back;

use App\Drawing;
use App\Recharges;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Session;

class AjaxStatusController extends Controller
{
    public function status()
    {
        $sessionId = Session::get('account_session_id');
        $saId = Session::get('account_id');
        $key = 'sa:'.md5($saId);
        Redis::select(4);
        if(Redis::exists($key)){
            $data = "[".Redis::get($key)."]";
            $dataDecode =  json_decode($data,true);
            $session_Id = $dataDecode[0]['session_id'];
            if($session_Id !== $sessionId){
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
            Redis::setex($key,600,$jsonEncode);     //重新赋予后台登陆时间

            $getCount = Recharges::where('status',1)->where('payType','!=','onlinePayment')->count();
            $getDrawCount = Drawing::where('status',0)->count();

            Redis::select(2);           //前台
            $onlineUserCount = DB::table('users_logintime')->where('logintime','>=',time()-300)->count();

            Redis::select(4);           //后台
            $onlineAdminCount = Redis::dbsize();

            return response()->json([
                'status' => true,
                'count' => $getCount,
                'drawCount' => $getDrawCount,
                'onlineUser' => $onlineUserCount,
                'onlineAdmin' => $onlineAdminCount,
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
