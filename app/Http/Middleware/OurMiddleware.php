<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class OurMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, string $role)
    {
        if($role !== "admin"){
            return abort("401");
        }
        return $next($request);
    }
}
