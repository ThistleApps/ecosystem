<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminSetting extends Model
{
    CONST DEF_DB_UN = 'def_db_un';
    CONST DEF_DB_PW = 'def_db_pw';
    CONST DEF_DB_NAME = 'def_db_name';
    CONST DEF_STRIPE_TEST = 'stripe_test';
    CONST DEF_STRIPE_LIVE = 'stripe_live';

    protected $guarded = [];

    /**
     * @param
     * @return array Stripe keys
     */
    public static function getStripeKey($key = null) {
        //todo:for now i just hardcoded that always take test stripe keys.
        $test = true;

        if ($test)
            $stripe_keys = self::query()->where('scope' , 'Test Api key')->pluck('value' , 'slug')->toArray();
        else
            $stripe_keys = self::query()->where('scope' , 'Live Api key')->pluck('value' , 'slug')->toArray();
        
        if (empty($stripe_keys))
        {
            $stripe_keys['stripe_pub'] = env('STRIPE_KEY');
            $stripe_keys['stripe_sec'] = env('STRIPE_SECRET');
        }

        return $key?$stripe_keys[$key]:$stripe_keys;
    }

}
