<?php

namespace App\Http\Middleware;

use App\LogHandle;
use Closure;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

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
        if($username !== 'admin') {
            $routeData = LogHandle::getTypeAction(Route::currentRouteName());
            $params = $request->all();
            $ip = $request->ip();
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
            if (DB::table('log_handle')->insert($data)) {
                return $next($request);
            }
            return response()->json(['error' => 'Adding log failed']);
        }
        return $next($request);
    }


}
