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
        $spark_properties = $user->sparkPlan();

        //todo: it just for the temporary hardcoded the developer email there should be the admin email
        $developers = [
            //'awaismusl@gmail.com',
            //'kwentllc@comcast.net',
            'admin@spyglassretail.com',
        ];
        if (!in_array($user->email, $developers) && $user->posType->name != 'Epicor (Eagle)')
/*        {
            auth()->logout();

            return response('Thanks for registering. We are currently working on this POS system and will contact you as soon as it is ready. If you require a custom quote then please let us know.!', 200);
        }*/

       /* {

            return redirect('/terms');
        }*/

        return $next($request);
    }
}
