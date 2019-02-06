<?php

namespace App\Http\Middleware;

use Closure;

class SecureHttp
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
        if(config('app.env') == 'production' && !$request->secure())
        {
            //return redirect()->secure($request->path());
        }
        return $next($request);
    }
}
