<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;

class CheckAdmin
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
        if ( !$request->isXmlHttpRequest()) {
            // 어드민 검사는 로그인 시 처리
            Log::info(__FILE__,[ __METHOD__=>"isAdmin :: set true in session"]);
            Log::info(__FILE__,[ __METHOD__=> $request->isXmlHttpRequest()]);
        }
        //$request->session()->flush();
        return $next($request);
    }
/*
    public function terminate($request, $response)
    {
        // Store the session data...
    }
*/
}
