<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminAuth
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
        if (auth()->check()) {
            // check user is admin or not
            if (!auth()->user()->is_admin) {
                return redirect()->route('getLogin')->with('error', 'Your have be Admin User to access this page');
            }
        } else {
            return redirect()->route('getLogin')->with('error', 'Your have to be logged in to access this page');
        }
        return $next($request);
    }
}
