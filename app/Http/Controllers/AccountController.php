<?php

namespace App\Http\Controllers;

use App\Agent;
use App\Http\Proxy\TokenProxy;
use App\Models\Chat\Users;
use App\User;
use Faker\Provider\DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Hash;
use GuzzleHttp\Client;

class AccountController extends Controller
{
    protected $proxy;
    /**
     * AccountController constructor.
     */
    public function __construct(TokenProxy $proxy)
    {
        $this->proxy = $proxy;
        $this->user = new User();
    }

    public function init(Request $request)
    {
        $user = JWTAuth::toUser($request->token);
        $hasFundPwd = false;
        if($user->fundPwd !== null){
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
    }

    public function getUserMsg(Request $request)
    {
        $user = JWTAuth::toUser($request->token);
        $nowTime = time();
        $userLastTime = strtotime($user->loginTime);
        $time = $nowTime - $userLastTime;
        if($time > Config::get('website.userOnlineDiffTime')*60) { User::where('id',$user->id)->update(['loginTime'=>date('Y-m-d H:i:s')]);}
        //return $time;
        $getUserBalance = Users::select('money')->where('id',$user->id)->first();
        return response()->json([
            'balance'=> $getUserBalance->money,
            '1'=>Config::get('website.userOnlineDiffTime')*60,
            '2'=>$time
        ]);
    }

    public function getMoney(Request $request)
    {
        $user = JWTAuth::toUser($request->token);
        return response()->json([
            'money' => $user->money
        ]);
    }

    public function updateMyPwd(Request $request)
    {
        $oldPwd = (string)$request->get('oldPwd');
        $newPwd = $request->get('newPwd');
        $user = JWTAuth::toUser($request->token);
        if(Hash::check($oldPwd, $user->password)){
            $update = User::where('id',$user->id)->update([
                'password'=>Hash::make($newPwd)
            ]);
            if($update == 1){
                return "ok";
            } else {
                return response()->json([
                    'success'=> false,
                    'msg'=> "密码修改失败，请稍后再试！",
                    'info'=> "",
                    "code"=>1003
                ],500);
            }
        } else {
            return response()->json([
                'success'=> false,
                'msg'=> "原始密码不正确",
                'info'=> "",
                "code"=>1004
            ],500);
        }
    }

    public function saveFundPwd(Request $request)
    {
        $loginPwd = $request->loginPwd;
        $user = JWTAuth::toUser($request->token);
        $fundPwd = $request->fundPwd;
        if(Hash::check($loginPwd, $user->password)){
            $update = User::where('id',$user->id)->update([
                'fundPwd' => Hash::make($fundPwd)
            ]);
            if($update == 1){
                return "ok";
            } else {
                return response()->json([
                    'success'=> false,
                    'msg'=> "取款密码保存失败，请稍后再试！",
                    'info'=> "",
                    "code"=>1003
                ],500);
            }
        } else {
            return response()->json([
                'success'=> false,
                'msg'=> "登录密码错误，请重试",
                'info'=> "",
                "code"=>1004
            ],500);
        }
    }

    public function updateFundPwd(Request $request)
    {
        $user = JWTAuth::toUser($request->token);
        $oldPwd = $request->oldPwd;
        $newPwd = $request->newPwd;
        if(Hash::check($oldPwd, $user->fundPwd)){
            $update = User::where('id',$user->id)->update([
                'fundPwd' => Hash::make($newPwd)
            ]);
            if($update == 1){
                return "ok";
            } else {
                return response()->json([
                    'success'=> false,
                    'msg'=> "取款密码更新失败，请稍后再试！",
                    'info'=> "",
                    "code"=>1003
                ],500);
            }
        } else {
            return response()->json([
                'success'=> false,
                'msg'=> "旧取款密码错误，请重试",
                'info'=> "",
                "code"=>1004
            ],500);
        }
    }
    
    public function checkUserNameExist(Request $request)
    {
        $success = false;
        $getUserName = $request->get('userName');
        $checkUserName = User::where('username',$getUserName)->count();
        if($checkUserName == 0){
            $success = true;
        }
        return response()->json([
            "code"=>0,
            "info"=>null,
            "msg"=>null,
            "success"=> $success
        ]);
    }

    public function register(Request $request)
    {
        $loginIp = $request->getClientIp();
        $loginHost = $request->getHttpHost();
        $loginClient = 2;
        $http = new Client();
        $res = $http->request('GET',"http://ip-api.com/json/$loginIp?lang=zh-CN");
        $jsonIp = json_decode((string) $res->getBody(), true);

        $token = null;
        $userName = $request->get('userName');
        $password = $request->get('password');
        $qq = $request->get('qq');
        $fundPwd = $request->get('fundPwd');
        $fullName = $request->get('fullName');
        $superUserName = $request->get('superUserName');

        $checkUserAlready = User::where('username',$userName)->count();
        if($checkUserAlready == 1)
        {
            return response()->json([
                'response' => 'error',
                'message' => '用户名已经存在！',
            ]);
        }

        $checkAgent = Agent::where('account',$superUserName)->first();
        if($checkAgent){
            $agent = $checkAgent->a_id;
        } else {
            $agent = 1;
        }

        $addUser = new User();
        $addUser->name = $userName;
        $addUser->email = 0;
        $addUser->username = $userName;
        $addUser->agent = $agent;
        $addUser->password = Hash::make($password);
        $addUser->qq = $qq;
        $addUser->fundPwd = null;
        $addUser->fullName = $fullName;
        $addUser->login_ip = $loginIp;
        $addUser->login_host = $loginHost;
        $addUser->login_client = $loginClient;
        $addUser->login_country = $jsonIp['country'];
        $addUser->login_ip_info = $jsonIp['country'].$jsonIp['regionName'].$jsonIp['city'].'-'.$jsonIp['isp'];
        $addUser->loginTime = date('Y-m-d H:i:s');
        $addUser->lastLoginTime = date('Y-m-d H:i:s');
        $insert = $addUser->save();
        if($insert == 1){
            return $this->proxy->proxy(['username'=>$userName,'password'=>$password]);
        } else {
            return "fail";
        }
    }

    public function logout()
    {
        return "logout!";
    }

    public function guestLogin(Request $request)
    {
        $account = $request->get('account');
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
                'success' => false,
                'msg' => '恶意访问，请联系客服 [抱歉，您已超过当日最大试玩次数]',
                'info' => '抱歉，您已超过当日最大试玩次数',
                'code' => 400
            ],500);
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
            $addGuest->login_client = 2;
            $save = $addGuest->save();
            if($save == 1){
                $getInfo = User::where('id',$addGuest->getQueueableId())->first();
                $getToken = $this->proxy->guestTokenProxy(['username'=>$guestRandName,'password'=>$password]);
                return response()->json([
                    'ipLoginTimes' => $loginIpTimes,
                    'loginIp' => $loginIp,
                    'lastLoginTime'=> $getInfo->lastLoginTime,
                    'loginTime'=> $getInfo->loginTime,
                    'money'=> $getInfo->money,
                    'result'=> 'ok',
                    'serverTime'=> $nowServerTime,
                    'testFlag'=> 1,
                    'token'=> $getToken,
                    'userId'=> $addGuest->getQueueableId(),
                    'username'=> $guestRandName
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'msg' => '无法开通试玩账号，请联系客服',
                    'info' => '',
                    'code' => 400
                ],500);
            }
        }
    }

    public function pc_login(Request $request)
    {
        $credentials = [
            'username' => $request->get('account'),
            'password' => $request->get('password')
        ];
        $token = null;
        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json([
                    'response' => 'error',
                    'message' => '账户与密码不符',
                ],401);
            }
        } catch (JWTAuthException $e) {
            return response()->json([
                'response' => 'error',
                'message' => '用户授权失败，请刷新重试',
            ],401);
        }
        if($token){
            Session::put('test','1111');
            return response()->json([
                'token'=>$token
            ]);
        }
    }
    
    public function login(Request $request)
    {
        $loginIp = $request->getClientIp();
        $loginHost = $request->getHttpHost();
        $loginClient = 2;
        $http = new Client();
        $res = $http->request('GET',"http://ip-api.com/json/$loginIp?lang=zh-CN");
        $jsonIp = json_decode((string) $res->getBody(), true);
        $credentials = [
            'username' => $request->get('username'),
            'password' => $request->get('password')
        ];
        $token = null;
        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json([
                    'response' => 'error',
                    'message' => '账户与密码不符',
                ],401);
            }
        } catch (JWTAuthException $e) {
            return response()->json([
                'response' => 'error',
                'message' => '用户授权失败，请刷新重试',
            ],401);
        }
        $user = Auth::user($request->get('username'));
        $update = User::where('id',$user->id)
            ->update([
                'login_ip'=>$loginIp,
                'login_host'=>$loginHost,
                'login_client'=>$loginClient,
                'login_country'=>$jsonIp['country'],
                'login_ip_info'=>$jsonIp['country'].$jsonIp['regionName'].$jsonIp['city'].'-'.$jsonIp['isp'],
                'loginTime'=>date('Y-m-d H:i:s'),
                'lastLoginTime'=>date('Y-m-d H:i:s')
            ]);
        if($update == 1){
            $getUserInfo = User::find($user->id);
            $hasFundPwd = false;
            if($getUserInfo->fundPwd !== null)
            {
                $hasFundPwd = true;
            }
            return response()->json([
                'userName' => $getUserInfo->username,
                'userId' => $getUserInfo->id,
                'updatePw' => $getUserInfo->updatePw,
                'updatePayPw' => $getUserInfo->updatePayPw,
                'token' => $token,
                'testFlag' => $getUserInfo->testFlag,
                'state'=> $getUserInfo->state,
                'serverTime' => date('Y-m-d H:i:s'),
                'rechLevel' => (string)$getUserInfo->rechLevel,
                'money' => $getUserInfo->money,
                'loginTime' => $getUserInfo->loginTime,
                'lastLoginTime' => $getUserInfo->lastLoginTime,
                'hasFundPwd'=> $hasFundPwd,
                'fullName' => $getUserInfo->fullName,
                'email' => $getUserInfo->email
            ]);
        } else {
            return response()->json([
                'response' => 'error',
                'message' => '登录服务器错误！',
            ],500);
        }
    }

    //刷新Token
    public function RefreshToken()
    {
        try {
            $old_token = JWTAuth::getToken();
            $token = JWTAuth::refresh($old_token);
            JWTAuth::invalidate($old_token);
        } catch (TokenExpiredException $e) {
            return response()->json(['token_expired'], $e->getStatusCode());
        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }
        return response()->json(compact('token'));
    }
}
