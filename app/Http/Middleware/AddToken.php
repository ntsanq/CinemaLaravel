<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AddToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $token = isset($_COOKIE["jwt_token"])?$_COOKIE["jwt_token"]:"";
        //$request['token'] = $token;//this is working
        $request->headers->set("Authorization", "Bearer $token");//this is working
        $response = $next($request);
        //$response->header('header name', 'header value');
        return $response;
    }
}
