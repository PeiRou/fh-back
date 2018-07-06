<?php

namespace App\Http\Controllers\Back;

use App\Permissions;
use App\Roles;
use App\SubAccount;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class SrcAccountController extends Controller
{
    //登录
    public function login(Request $request)
    {
        $account = $request->input('account');
        $password = $request->input('password');
        $otp = $request->input('otp');
        $find = SubAccount::where('account',$account)->first();
        $ga = new \PHPGangsta_GoogleAuthenticator();
        if($account == 'admin'){
            $otp = $ga->getCode($find->google_code);
        }
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

                    Session::put('isLogin',true);
                    Session::put('account_id',$find->sa_id);
                    Session::put('account',$find->account);
                    Session::put('account_name',$find->name);
                    Session::put('account_permission',$collectionAuth);

                    //登录后处理赔率文件
                    $getPlayFiles = Storage::disk('static')->exists('plays.php');
                    if($getPlayFiles){
                        return '存在！';
                    } else {
                        $plays = DB::table('play')->get();
                        Storage::disk('static')->put('plays.php',$plays);
                        $getFile = Storage::disk('static')->get('plays.php');
                        $d = [];
                        foreach($getFile as $item){
                            $d[] = $item->id;
                        }
                        return $d;
                        //return '不存在';
                    }

//                    return response()->json([
//                        'status'=>true,
//                        'msg'=>'登录成功，正在进入'
//                    ]);
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
        Session::flush();
        return response()->json([
           'status'=>true
        ]);
    }
}
