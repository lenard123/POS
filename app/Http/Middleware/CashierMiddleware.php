<?php

namespace App\Http\Middleware;

use Closure;
use App\Http\Controllers\Conf;

class CashierMiddleware
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

        if (request()->user()->type == Conf::ROLE_CASHIER)
            return $next($request);
        else
            return redirect()->route('admin');
    }
}
