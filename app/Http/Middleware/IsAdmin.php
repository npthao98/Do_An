<?php

namespace App\Http\Middleware;

use Closure;

class IsAdmin
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
        $admin = auth()->user()->employee;
        if (auth()->user() && $admin) {
            return $next($request);
        }

        return redirect()->route('index');
    }
}
