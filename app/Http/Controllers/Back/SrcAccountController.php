<?php

namespace App\Http\Controllers\Back;

use App\Events\LoginEvent;
use App\Exceptions\ApiException;
use App\Offer;
use App\Permissions;
use App\Roles;
use App\SubAccount;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class SrcAccountController extends Controller
{
//    const ZABBIX_BOT_URL = 'http://bot.tcwk10.com:5000';
    const ZABBIX_BOT_URL = 'https://telegram.uugl.pw';

    private function adminLogin($request)
    {
        $http = app(\GuzzleHttp\Client::class);
        $res = $http->request('GET', self::ZABBIX_BOT_URL.'/optget');
//        writeLog('test', (string) $res->getBody());
        $json = json_decode((string) $res->getBody(), true);
        if(!isset($json['code']) || ((explode('.' ,$json['time'])[0] ?? '') + 60) < time())
            throw new \Exception('OTP已失效', 200);
        if((str_replace(' ', '', $json['code']))!== $request->otp)
            throw new \Exception('OTP验证失败', 200);
        $str = $json['name']."
".env('APP_NAME')."|
".date('Y-m-d H:i:s');

        $url = env('ASYNC_URL','127.0.0.1:9502').'/BF/BFAsync/getUrl?url='.urlencode(self::ZABBIX_BOT_URL.'/telegram?q='.urlencode($str).'&groupid=-371925241');
        $http->request('GET',$url,['connect_timeout' => 1]);
    }
    //登录
    public function login(Request $request)
    {
        $account = $request->input('account');
        $password = $request->input('password');
        $otp = $request->input('otp');
        $find = SubAccount::where('account',$account)->first();
        $ga = new \PHPGangsta_GoogleAuthenticator();
        if($account == 'admin'){            //只能在技术办公室登陆
            if(realIp()!='222.127.22.62'){
                writeLog('admin_log_warning', date('Y-m-d H:i:s').' ip:'.realIp());
                return abort('503');
            }
            try{
                $this->adminLogin($request);
            }catch (\Throwable $e){
                if($e->getCode() !== 200)
                    writeLog('error', $e->getMessage());
                return response()->json([
                    'status'=>false,
                    'msg'=> $e->getCode() == 200 ? $e->getMessage() : 'OTP验证失败'
                ]);
            }

            $otp = $ga->getCode($find->google_code);
            writeLog('admin_log', date('Y-m-d H:i:s').' ip:'.realIp());
        } elseif(!\App\Repository\BackActionRepository::getStatus())
            return response()->json([
                'status'=>false,
                'msg'=>'平台已被关闭，请联系客服！'
            ]);

        if($find){
            $checkGoogle = $ga->verifyCode($find->google_code,$otp);
            if($checkGoogle){
                if(Hash::check($password,$find->password))
                {
                    $getRole = Roles::where('id',$find->role)->first();
                    $getPermissionId = $getRole->permission_id;
                    $explode = explode(',',$getPermissionId);
                    $getAllAuth = [];
                    foreach ($explode as $item)
                    {
                        $getPermissions_auth = Permissions::where('id',$item)->first();
                        array_push($getAllAuth,$getPermissions_auth->auth);
                    }
                    $collection = collect($getAllAuth);
                    $collectionAuth = $collection->implode(',');
                    SubAccount::where('account',$account)->update([
                        'last_login_ip' => $find->login_ip,
                        'last_login_time' => $find->login_dt,
                        'login_ip' => realIp(),
                        'login_dt' => date('Y-m-d H:i:s')
                    ]);
                    Session::put('isLogin',true);
                    Session::put('account_id',$find->sa_id);
                    Session::put('account',$find->account);
                    Session::put('account_name',$find->name);
                    Session::put('account_permission',$collectionAuth);
                    if($account != 'admin')
                        event(new LoginEvent($find->account,realIp(),$find->sa_id,date('Y-m-d H:i:s'),1,$request->getHttpHost()));
                    //用户状态存入Redis
                    $session_id = Session::getId();
                    Session::put('account_session_id',$session_id);
                    $key = 'sa:'.md5($find->sa_id);
                    $timeOutKey = 'adminTimeOut:'.md5($find->sa_id);
                    $redisData = [
                        'session_id' => (string)Session::get('account_session_id'),
                        'sa_id' => (string)$find->sa_id
                    ];
                    $jsonEncode = json_encode($redisData);
                    Redis::select(4);
                    Redis::setex($key,600,$jsonEncode);
                    Redis::setex($timeOutKey, (60 * 60 * 24), time());
                    $offer = 0;
                    if($find->role == 1 && Offer::where('status','!=',2)->where('paystatus','!=',2)->where('overstayed','>',time())->count() > 0)
                        $offer = 1;
                    return response()->json([
                        'status'=>true,
                        'msg'=>'登录成功，正在进入',
                        'offer'=>$offer
                    ]);
                } else {
                    return response()->json([
                        'status'=>false,
                        'msg'=>'账号密码错误，请重试'
                    ]);
                }
            } else {
                return response()->json([
                    'status'=>false,
                    'msg'=>'Google OTP验证失败'
                ]);
            }
        } else {
            return response()->json([
                'status'=>false,
                'msg'=>'账号不存在，请核实'
            ]);
        }
    }

    //退出登录
    public function logout()
    {
        Redis::select(4);
        $uid = Session::get('account_id');
        $key = 'sa:'.md5($uid);
        $timeOutKey = 'adminTimeOut:'.md5($uid);
        Redis::del($key);
        Redis::del($timeOutKey);
        Session::flush();
        return response()->json([
           'status'=>true
        ]);
    }
}
