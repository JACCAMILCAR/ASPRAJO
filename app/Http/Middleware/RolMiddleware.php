<?php

namespace App\Http\Middleware;

use Closure;

class RolMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$rols)
    {
        // dd($rols);
        foreach ($rols as $rol) {
            if(auth()->user()->hasRol($rol)) {
                return $next($request);
            }
        }
        abort(404);
    }
}
