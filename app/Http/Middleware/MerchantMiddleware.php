<?php

namespace App\Http\Middleware;

use Closure;

class MerchantMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!auth()->check()) {
            return $next($request);
        }

        if (!auth()->user()->hasRole('Merchant') && !auth()->user()->hasRole('Admin')) {
            return response('You Do Not Have Correct Permissions For This Feature!', 401);
        }

        return $next($request);
    }
}
