<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        $stripe_keys = \App\Models\AdminSetting::getStripeKey();
        if (isset($stripe_keys['stripe_pub']) && !empty(trim($stripe_keys['stripe_pub'])) && isset($stripe_keys['stripe_sec']) && !empty(trim($stripe_keys['stripe_sec'])) )
        {
            setEnvValue('STRIPE_KEY' ,"services.stripe.key",  $stripe_keys['stripe_pub']);
            setEnvValue('STRIPE_SECRET' , "services.stripe.secret" , $stripe_keys['stripe_sec']);
        }

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
