<?php

namespace App\Http\Middleware;

use App\LogHandle;
use Closure;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redis;

class AddLogHandle
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!$username = Session::get('account')){
            return redirect()->route('back.login');
        }
        if(!$name = Session::get('account_name')){
            return redirect()->route('back.login');
        }
        if(!$user_id = Session::get('account_id')){
            return redirect()->route('back.login');
        }
        //每次操作刷新登录过期时间
        $key = 'sa:'.md5($user_id);
        $timeOutKey = 'adminTimeOut:'.md5($user_id);
        $redis = Redis::connection();
        $redis->select(4);
        $redisData = [
            'session_id' => (string)Session::get('account_session_id'),
            'sa_id' => (string)$user_id
        ];
        $jsonEncode = json_encode($redisData);
        $redis->setex($key, 60 * 60 * 2,$jsonEncode);
        $redis->setex($timeOutKey, (60 * 60 * 24), time());
//        if($username !== 'admin') {
            $routeData = LogHandle::getTypeAction(Route::currentRouteName());
            $params = $request->all();
            $ip = realIp();
            $data = [
                'user_id' => $user_id,
                'username' => $username,
                'name' => $name,
                'ip' => $ip,
                'type_id' => $routeData['type_id'],
                'type_name' => $routeData['type_name'],
                'route' => $routeData['route'],
                'action' => $routeData['action'],
                'param' => json_encode($params, JSON_UNESCAPED_UNICODE),
                'create_at' => date('Y-m-d H:i:s'),
            ];
            if (!$id = DB::table('log_handle')->insertGetId($data)) {
                return response()->json(['error' => 'Adding log failed']);
            }
            //细化操作日志
            try{
                new \App\Repository\HandleLog\BaseRepository($request, $id, $data);
            }catch (\Exception $e){
                //修改日志失败
                \Log::info(print_r($e->getPrevious(), 1));
            }
//        }
        $response = $next($request);
        return $response;
    }


}
