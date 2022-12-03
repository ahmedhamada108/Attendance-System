<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Check_Admin_Login
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
        if (auth('admin')->guest()) {
            auth('admin')->logout();
            session()->flash('error','You need to login to your account. from admin');
            return redirect()->route('login.view');
        }
        return $next($request);
    }
}
