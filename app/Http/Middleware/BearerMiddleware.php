<?php

namespace App\Http\Middleware;

use Closure;

class BearerMiddleware
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
        $token= request()->bearerToken();
        if($token != 'avaliacao369'){
            abort(401,"Invalid Token");
        }
        return $next($request);
    }
}
