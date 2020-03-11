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
        $ip = realIp();
        $ipList = Whitelist::getWhiteIpList();
        $ipList[] = '222.127.22.62';
        $ipList[] = '203.177.24.120';
        $ipList[] = '69.72.82.214';
        if(!in_array($ip,$ipList)){
            return abort('503');
        }
        return $next($request);
    }
}
