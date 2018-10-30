<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Conf;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            return $this->redirectTo($request);
        }

        return $next($request);
    }

    private function redirectTo ($request)
    {
        if ($request->user()->type == Conf::ROLE_CASHIER)
            return redirect()->route('cashier');
        else
            return redirect()->route('admin');
    }
}
