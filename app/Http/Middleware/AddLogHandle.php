<?php

namespace App\Http\Middleware;

use App\Helpers\RouteConfig;
use App\LogHandle;
use Closure;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Tymon\JWTAuth\Facades\JWTAuth;

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
        if(empty(Session::get('account_id')))
            return view('back.O_adminLogin');
        $routeData = LogHandle::getTypeAction(Route::currentRouteName());
        $ip = $request->ip();
        $params = $request->all();
        $username = Session::get('account');
        $name = Session::get('account_name');
        $user_id = Session::get('account_id');

        $data = [
            'user_id' => $user_id,
            'username' => $username,
            'name' => $name,
            'ip' => $ip,
            'type_id' => $routeData['type_id'],
            'type_name' => $routeData['type_name'],
            'route' => $routeData['route'],
            'action' => $routeData['action'],
            'param' => json_encode($params),
        ];
        if(DB::table('log_handle')->insert($data)){
              return $next($request);
        }
        return response()->json(['error'=>'Adding log failed']);
    }


}
