<?php

namespace App\Http\Middleware;

use App\Whitelist;
use Closure;

class CheckIP
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
        $ip = $request->ip();
        $ipList = Whitelist::getWhiteIpList();
        if(!in_array($ip,$ipList)){
            return abort('503');
        }
        return $next($request);
    }
}
