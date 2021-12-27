<?php

namespace App\Http\Middleware;

use Closure;

class CheckNotUserLogin
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
        if (Session()->has('user') && Session()->has('user_id')){
            return redirect('/user/login');
        }

        return $next($request);
    }
}
