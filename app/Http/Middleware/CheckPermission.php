<?php

namespace App\Http\Middleware;

use App\Roles;
use App\SubAccount;
use Closure;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class CheckPermission
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
        $getAccountPermission = Session::get('account_permission');
        if(!$getAccountPermission)
        {
            return redirect()->route('back.login');
        }

        $permissionArray = explode(',',$getAccountPermission);
        $previousUrl = URL::previous();
        $routeName = Route::currentRouteName();
        if(in_array($routeName,$permissionArray))
        {
            return $next($request);
        } else {
            return response()->view('403',compact('previousUrl'),403);
        }
    }
}
