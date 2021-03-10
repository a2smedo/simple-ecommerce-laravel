<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Dashboard
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
        $ruleName = Auth::user()->rule->name;

        if ($ruleName == 'superadmin' or $ruleName == 'admin' ) {
            return $next($request);
        }

        return redirect(url("/"));
    }
}
