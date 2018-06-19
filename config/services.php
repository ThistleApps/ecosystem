<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, Mandrill, and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
     */

    'authy'     => [
        'secret' => env('AUTHY_SECRET'),
    ],

    'mailgun'   => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses'       => [
        'key'    => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'stripe'    => [
        'model'  => App\User::class,
        'key'    => env('STRIPE_KEY', config('admin_settings.stripe_pub')),
        'secret' => env('STRIPE_SECRET', config('admin_settings.stripe_sec')),
    ],

    'mailchimp' => [
        'client_id'     => env('MAILCHIMP_CLIENT_ID'),
        'client_secret' => env('MAILCHIMP_CLIENT_SECRET'),
    ],

];
