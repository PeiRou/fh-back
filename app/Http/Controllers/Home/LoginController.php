<?php

namespace App\Http\Controllers\Home;

use App\Http\Proxy\TokenProxy;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;


class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/welcome';
    protected $proxy;

    public function __construct(TokenProxy $proxy)
    {
        $this->proxy = $proxy;
        $this->user = new User();
    }

    public function login(Request $request){
//        if($request->isTest !== 'yes'){
//            if($request->input('captcha')!==session('captcha')){
//                return response()->json(['code'=>'验证码错误！'],200);
//            }
//        }

        if (!$this->attemptLogin($request)) {
            return response()->json(['code'=>'用户名或密码错误！'],200);
        } else {
            Session::put('isLoginPc',1);
            return response()->json(['success'],200);
        }
    }

    public function username()
    {
        return 'username';
    }

    public function guestLogin(Request $request)
    {
        $account = $request->get('username');
        $password = $request->get('password');
        $loginIp = $request->getClientIp();
        $loginHost = $request->getHttpHost();
        $nowServerTime = date('Y-m-d H:i:s');
        $guestMoney = Config::get('website.guestMoney');
        $guestTryTimes = Config::get('website.guestTryTimes');
        $token = null;
        $rand = time().rand(10000,99999);
        $guestRandName = 'guest_'.$rand;

        //当天同一IP的登录次数
        $nowDate = date('Y-m-d');
        $loginIpTimes = DB::table('users')->where('testFlag',1)->whereDate('created_at', $nowDate)->groupBy('login_ip')->count();
        if($loginIpTimes > $guestTryTimes){
            return response()->json([
                'status' => false,
                'msg' => '恶意访问，请联系客服 [抱歉，您已超过当日最大试玩次数]',
                'info' => '抱歉，您已超过当日最大试玩次数',
                'code' => 400
            ]);
        } else {
            $addGuest = new User();
            $addGuest->agent = 1;
            $addGuest->name = $guestRandName;
            $addGuest->username = $guestRandName;
            $addGuest->email = 0;
            $addGuest->password = Hash::make($password);
            $addGuest->fullName = $guestRandName;
            $addGuest->loginTime = $nowServerTime;
            $addGuest->lastLoginTime = $nowServerTime;
            $addGuest->money = $guestMoney;
            $addGuest->testFlag = 1;
            $addGuest->login_ip = $loginIp;
            $addGuest->login_host = $loginHost;
            $addGuest->login_client = 1;
            $save = $addGuest->save();
            if($save == 1){
                $getInfo = User::where('id',$addGuest->getQueueableId())->first();
                $getToken = $this->proxy->guestTokenProxy(['username'=>$guestRandName,'password'=>$password]);
                return response()->json([
                        'status' => true,
                        'token' => $getToken,
                        'guestAccount' => $getInfo->username
                    ]);
            } else {
                return response()->json([
                    'status' => false,
                    'msg' => '无法开通试玩账号，请联系客服',
                    'info' => '',
                    'code' => 400
                ]);
            }
        }
    }

    protected function validateLogin(Request $request){
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
        ]);
    }


    public function init(Request $request)
    {
        $isLoginPC = Session::get('isLoginPc');
        if($isLoginPC == 1){
            if(!auth()->guard()->check()){
                return response()->json(['code'=>0],200);
            };
            $user = auth()->guard()->user();
            $hasFundPwd = false;
            if($user->fundPwd !== ""){
                $hasFundPwd = true;
            }
            return response()->json([
                "token"=>$request->token,
                "serverTime"=>date('Y-m-d H:i:s'),
                "userId"=>$user->id,
                "userName"=>$user->username,
                "fullName"=>$user->fullName,
                "loginTime"=>"2018-01-22 15:20:05",
                "lastLoginTime"=>"2018-01-22 12:11:27",
                "money"=>$user->money,
                "email"=>$user->email,
                "rechLevel"=>(string)$user->rechLevel,
                "hasFundPwd"=>$hasFundPwd,
                "testFlag"=>$user->testFlag,
                "updatePw"=>$user->updatePw,
                "updatePayPw"=>$user->updatePayPw,
                "state"=>$user->state
            ]);
        } else {
            return response()->json([
                'login' => false
            ]);
        }

    }
}
