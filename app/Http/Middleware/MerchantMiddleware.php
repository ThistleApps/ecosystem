<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Routing\Route;

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

        $user             = auth()->user();
        //$spark_properties = $user->sparkPlan();

        //todo: it just for the temporary hardcoded the developer email there should be the admin email
        $developers = [
            'admin@spyglassretail.com',
        ];

        if (!in_array($user->email, $developers) )
        {
            auth()->logout();

            return redirect('/merchantpage');

        }

        return $next($request);
    }
}
