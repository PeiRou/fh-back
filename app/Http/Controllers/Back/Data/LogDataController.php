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
        $startTime = $request->get('startTime');
        $endTime = $request->get('endTime');
        $start = $request->get('start');
        $length = $request->get('length');

        $loginLogSql = DB::table('log_login')
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
            ->where(function ($q) use ($startTime){
                if($startTime && isset($startTime)){
                    $q->where('login_time','>=',$startTime . ' 00:00:00');
                }
            })
            ->where(function ($q) use ($endTime){
                if($endTime && isset($endTime)){
                    $q->where('login_time','<=',$endTime . ' 23:59:59');
                }
            });
        $loginLogCount = $loginLogSql->count();
        $loginLog = $loginLogSql->orderBy('id','DESC')->skip($start)->take($length)->get();
        return DataTables::of($loginLog)
            ->setTotalRecords($loginLogCount)
            ->editColumn('ip_info',function($logHandle){
                return "<span><i class='iconfont'>&#xe627;</i>$logHandle->ip_info<span  class=\"refreshIp\"  onclick='refreshIp({$logHandle->id},\"{$logHandle->ip}\", this)' >刷新</span></span>";
            })
            ->rawColumns(['ip_info'])
            ->skipPaging()
            ->make(true);
    }

    public function adminLogin(Request $request)
    {
        $name = $request->get('username');
        $ip = $request->get('ip');
        $loginHost = $request->get('loginHost');
        $ipInfo = $request->get('ipInfo');
        $startTime = $request->get('startTime');
        $endTime = $request->get('endTime');
        $start = $request->get('start');
        $length = $request->get('length');

        $loginLogSql = DB::table('log_admin_login')
            ->where(function ($q) use ($name){
                if($name && isset($name)){
                    $q->where('name',$name);
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
            ->where(function ($q) use ($startTime){
                if($startTime && isset($startTime)){
                    $q->where('login_time','>=',$startTime . ' 00:00:00');
                }
            })
            ->where(function ($q) use ($endTime){
                if($endTime && isset($endTime)){
                    $q->where('login_time','<=',$endTime . ' 23:59:59');
                }
            });
        $loginLogCount = $loginLogSql->count();
        $loginLog = $loginLogSql->orderBy('id','DESC')->skip($start)->take($length)->get();
        return DataTables::of($loginLog)
            ->setTotalRecords($loginLogCount)
            ->editColumn('ip_info',function($logHandle){
                return "<span><i class='iconfont'>&#xe627;</i>$logHandle->ip_info<span  class=\"refreshIp\"  onclick='refreshIp({$logHandle->id},\"{$logHandle->ip}\", this)' >刷新</span></span>";
            })
            ->rawColumns(['ip_info'])
            ->skipPaging()
            ->make(true);
    }
    public function logHandle(Request $request){
        $param = $request->all();
        $logHandleSql = LogHandle::where(function ($sql) use ($param){
            if(isset($param['username']) && array_key_exists('username',$param)){
                $sql->where('log_handle.username','=',$param['username']);
            }
            if(isset($param['type_id']) && array_key_exists('type_id',$param)){
                $sql->where('log_handle.type_id','=',$param['type_id']);
            }
            if(isset($param['param']) && array_key_exists('param',$param)){
                $sql->where('log_handle.param','=',$param['param']);
            }
            if(isset($param['startTime']) && array_key_exists('startTime',$param)){
                $sql->where('log_handle.create_at','>=',$param['startTime'] . ' 00:00:00');
            }
            if(isset($param['endTime']) && array_key_exists('endTime',$param)){
                $sql->where('log_handle.create_at','<=',$param['endTime'] . ' 23:59:59');
            }
        });
        $logHandleCount =  $logHandleSql->count();
        $logHandle = $logHandleSql->select('log_handle.id','log_handle.user_id','log_handle.username','log_handle.type_name','log_handle.ip','permissions_auth.auth_name as paction','log_handle.action as action','log_handle.create_at','log_handle.param')
            ->leftJoin('permissions_auth','permissions_auth.route_name','=','log_handle.route')
            ->orderBy('create_at','desc')->skip($param['start'])->take($param['length'])->get();
        return DataTables::of($logHandle)
            ->editColumn('action',function ($logHandle){
                $str = $logHandle->action;
                if(!empty(json_decode($logHandle->param))){
                    $str .= " 使用参数： ".$logHandle->param;
                }
                return $str;

            })
            ->setTotalRecords($logHandleCount)
            ->skipPaging()
            ->make(true);
    }

    public function logAbnormal(Request $request){
        $param = $request->all();
        $logAbnormalSql = LogAbnormal::where(function ($sql) use ($param){
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
        });
        $logAbnormalCount = $logAbnormalSql->count();
        $logAbnormal = $logAbnormalSql->orderBy('create_at','desc')->skip($param['start'])->take($param['length'])->get();
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
            ->setTotalRecords($logAbnormalCount)
            ->skipPaging()
            ->make(true);
    }
}
