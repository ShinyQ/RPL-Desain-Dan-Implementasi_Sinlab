<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class LoggedMiddleware
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
        if(request()->session()->get('user')){
            return $next($request);
        }

        return redirect('/user/login')->with('error', 'Anda Harus Login Terlebih Dahulu');
    }
}
