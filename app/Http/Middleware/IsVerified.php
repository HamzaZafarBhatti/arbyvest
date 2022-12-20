<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsNotVerified
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
        $is_verified = auth()->user()->is_verified;
        if(!$is_verified) {
            return $next($request);
        }
        return back();
    }
}
