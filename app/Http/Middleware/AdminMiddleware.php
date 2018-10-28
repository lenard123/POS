<?php

namespace App\Http\Middleware;

use Closure;
use App\Http\Controllers\Conf;

class AdminMiddleware
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

        if ($this->isAdmin())
            return $next($request);
        else
            return redirect()->route('cashier');
    }

    private function isAdmin()
    {
        $user = request()->user();
        $type = $user->type;
        return $type == Conf::ROLE_ADMIN || $type == Conf::ROLE_SUBADMIN;
    }
}
