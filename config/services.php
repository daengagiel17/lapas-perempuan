<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
        'webhook' => [
            'secret' => env('STRIPE_WEBHOOK_SECRET'),
            'tolerance' => env('STRIPE_WEBHOOK_TOLERANCE', 300),
        ],
    ],

    'facebook' => [
        'client_id' => '2577374435619935',
        'client_secret' => 'cdf4b5a5aaa3ac15ed298bcd865ac595',
        'redirect' => 'http://localhost:8000/auth/facebook/callback',
    ],

    'twitter' => [
        'client_id' => 'BbqtIZCGZXgSCt16V4AfVVh5z',
        'client_secret' => 'sBXUGd4opVQJ3gtQWhjRcyFgcvP2mootazFAVcQnu5J7G3wTLw',
        'redirect' => 'http://localhost:8000/auth/twitter/callback',
    ],

    'google' => [
        'client_id' => '1016193014843-jn6cfrpi500qh10cutr0o2pvuspf0l73.apps.googleusercontent.com',
        'client_secret' => '4aNb0OmexThRAppa5Me4yci1',
        'redirect' => 'http://localhost:8000/auth/google/callback',
    ],     
];
