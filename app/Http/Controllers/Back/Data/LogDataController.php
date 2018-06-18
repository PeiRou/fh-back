<?php

namespace App\Http\Controllers\Back\Data;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class LogDataController extends Controller
{
    public function login(Request $request)
    {
        $username = $request->get('username');
        $ip = $request->get('ip');
        $loginHost = $request->get('loginHost');
        $ipInfo = $request->get('ipInfo');

        $loginLog = DB::table('log_login')
            ->where(function ($q) use ($username){
                if($username && isset($username)){
                    $q->where('username',$username);
                }
            })
            ->where(function ($q) use ($ip){
                if($ip && isset($ip)){
                    $q->where('ip',$ip);
                }
            })
            ->where(function ($q) use ($loginHost){
                if($loginHost && isset($loginHost)){
                    $q->where('login_host',$loginHost);
                }
            })
            ->where(function ($q) use ($ipInfo){
                if($ipInfo && isset($ipInfo)){
                    $q->where('ip_info',$ipInfo);
                }
            })
            ->get();
        return DataTables::of($loginLog)
            ->make(true);
    }
}
