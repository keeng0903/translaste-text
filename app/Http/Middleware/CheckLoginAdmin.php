<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class CheckLoginAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!session()->has('email') && !in_array(Route::currentRouteName(), ['admin.login', 'admin.confirm'])){
            return redirect('admin/login');
        }

        if (session()->has('email') && url('admin/login') == $request->url() && in_array(Route::currentRouteName(), ['admin.login', 'admin.confirm'])){
            return redirect('admin/dashboard');
        }
        return $next($request);
    }
}
