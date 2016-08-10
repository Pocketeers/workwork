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

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'mailchimp' => [
        'secret' => 'c6bc91221a5a6d0cbb51d137770a20c7-us13',
        'list' => '0c8964f31e',        
    ],

    'facebook' => [
        'client_id' => '1578992975731734',
        'client_secret' => '0cf182a8fe4ec8f076c75d7271181ffa',
        'redirect' => 'http://workwork.app/callback',
    ],

    'algolia' => [
        'app_id' => env('ALGOLIA_APP_ID'),
        'api_key' => env('ALGOLIA_API_KEY')

    ],

    'twilio' => [
        'acc_id' => env('TWILIO_ACC_ID'),
        'auth_token' => env('TWILIO_AUTH_TOKEN')

    ],

    'braintree' => [
        'model'  => App\User::class,
        'environment' => env('BRAINTREE_ENV'),
        'merchant_id' => env('BRAINTREE_MERCHANT_ID'),
        'public_key' => env('BRAINTREE_PUBLIC_KEY'),
        'private_key' => env('BRAINTREE_PRIVATE_KEY'),
    ]
    
];
