<?php

namespace App\Http\Controllers\Agent;

use App\Agent;
use App\Http\Controllers\Home\CaptchaController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AgentAccountController extends Controller
{
    public function login()
    {
        $captcha = CaptchaController::makeCaptcha();
        return view('agent.login',compact('captcha'));
    }
    
    //代理登录
    public function loginAction(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');
        $vlicode = $request->input('vlicode');
        if($vlicode!==session('captcha')){
            return response()->json(['status'=>false,'msg'=>'验证码错误'],200);
        }
        $findAgent = Agent::where('account',$username)->first();
        if($findAgent){
            if(Hash::check($password,$findAgent->password)){
                Session::put('agent_account',$findAgent->account);
                Session::put('agent_id',$findAgent->a_id);
                Session::put('agent_name',$findAgent->name);
                Session::put('agentIsLogin',1);
                return response()->json(['status'=>true],200);
            } else {
                return response()->json(['status'=>false,'msg'=>'账号与密码不符'],200);
            }
        } else {
            return response()->json(['status'=>false,'msg'=>'代理不存在'],200);
        }
    }
}
