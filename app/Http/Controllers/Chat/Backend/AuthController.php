<?php

namespace App\Http\Controllers\Chat\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{


    // Auth验证登录
    public function login(Request $request)
    {


//        $request->session()->regenerate();
//        $this->clearLoginAttempts($request);

        $name = $request->input('name');
        $pass = $request->input('password');

        if(Auth::guard('chat')->attempt(['name'=>$name, 'password'=>$pass], $request->filled('remember'))) {
            $user = Auth::guard('chat')->user();
            $data = array(
                'status' => 0,
                'message' => '登录成功',
                'user' => array(
                    'name' => $user['name'],
                )
            );
        }else {
            $data = array(
                'status' => 1,
                'message' => '用户名或密码不正确',
            );
        }
        return response()->json($data,200);
    }

    // Auth验证当前登录用户
    public function checkUser()
    {

        return Auth::guard('chat')->check() ? 0 : 1;

    }

    /**修改密码**/
    public function setting(Request $request){
        $this->validate($request, array(
            'pass'      => 'required|min:6',
            'passed'    => 'required|min:6'
        ));

        if ( Hash::check($request->input('passed'), Auth::guard('chat')->getAuthPassword())) {
            $result = Auth::guard('chat')->user()->fill(array(
                'password' => Hash::make($request->input('pass'))
            ))->save();
            if($result) {
                Auth::guard('chat')->logout();
                return response()->json(array(
                    'status' => 0,
                    'message' => '修改成功'
                ));
            }else {
                return response()->json(array(
                    'status' => 1,
                    'message' => '修改失败'
                ));
            }
        }else{
            return response()->json(array(
                'status' => 1,
                'message' => '旧密码输入错误'
            ));
        }
    }

    // 退出登录
    public function logout()
    {
        Auth::guard('chat')->logout();
        return response()->json(array('status' => 0, 'message' => '退出成功'));
    }





}
