<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Route;

class CheckLoginUser
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
        if (!session()->has('user') && !in_array(Route::currentRouteName(), ['user.login', 'user.confirm', 'user.confirm-register'])){
            return redirect('/home')->with('status', 'Bạn chưa đăng nhập!');
        }

        if (session()->has('user') && url('user/login') == $request->url() && in_array(Route::currentRouteName(), ['user.login', 'user.confirm'])){
            return redirect('/home');
        }
        return $next($request);
    }
}
