<?php

namespace App\Http\Controllers\Back\Data;

use App\LogAbnormal;
use App\LogHandle;
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
            ->orderBy('id','DESC')->get();
        return DataTables::of($loginLog)
            ->make(true);
    }

    public function logHandle(Request $request){
        $param = $request->all();
        $logHandle = LogHandle::where(function ($sql) use ($param){
            if(isset($param['username']) && array_key_exists('username',$param)){
                $sql->where('username','=',$param['username']);
            }
            if(isset($param['type_id']) && array_key_exists('type_id',$param)){
                $sql->where('type_id','=',$param['type_id']);
            }
            if(isset($param['param']) && array_key_exists('param',$param)){
                $sql->where('param','=',$param['param']);
            }
            if(isset($param['startTime']) && array_key_exists('startTime',$param)){
                $sql->where('create_at','>=',$param['startTime'] . ' 00:00:00');
            }
            if(isset($param['endTime']) && array_key_exists('endTime',$param)){
                $sql->where('create_at','<=',$param['endTime'] . ' 23:59:59');
            }
        })->orderBy('create_at','desc')->get();
        return DataTables::of($logHandle)
            ->editColumn('param',function ($logHandle){
                if(empty(json_decode($logHandle->param))){
                    return '-';
                }else{
                    return $logHandle->param;
                }
            })
            ->make(true);
    }

    public function logAbnormal(Request $request){
        $param = $request->all();
        $logAbnormal = LogAbnormal::where(function ($sql) use ($param){
            if(isset($param['type_id']) && array_key_exists('type_id',$param)){
                $sql->where('type_id','=',$param['type_id']);
            }
            if(isset($param['ip']) && array_key_exists('ip',$param)){
                $sql->where('ip','=',$param['ip']);
            }
            if(isset($param['startTime']) && array_key_exists('startTime',$param)){
                $sql->where('create_at','>=',$param['startTime'] . ' 00:00:00');
            }
            if(isset($param['endTime']) && array_key_exists('endTime',$param)){
                $sql->where('create_at','<=',$param['endTime'] . ' 23:59:59');
            }
        })->orderBy('create_at','desc')->get();
        return DataTables::of($logAbnormal)
            ->editColumn('param',function ($logHandle){
                if(empty(json_decode($logHandle->param))){
                    return '-';
                }else{
                    return $logHandle->param;
                }
            })
            ->editColumn('user_id',function ($logHandle){
                if(empty($logHandle->user_id)){
                    return '-';
                }else{
                    return $logHandle->user_id;
                }
            })
            ->editColumn('name',function ($logHandle){
                if(empty($logHandle->name)){
                    return '-';
                }else{
                    return $logHandle->name;
                }
            })
            ->editColumn('route',function ($logHandle){
                if(empty($logHandle->route)){
                    return '-';
                }else{
                    return $logHandle->route;
                }
            })
            ->make(true);
    }
}
