<?php

namespace App\Http\Middleware;

use Closure;

class domainCheck
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
        $host = $_SERVER['HTTP_HOST'];
        //if($host !== '0123500w.com' && $host !== "103.99.63.229:9527"){
        //if($host !== '0123500w.com' && $host !== "103.99.63.229:9527"){
            //return abort(404);
        //} else {
            return $next($request);
        //}
        //return $next($request);
    }
}
