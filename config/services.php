<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
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

    'facebook' => [
        'client_id' => '494157958577410',
        'client_secret' => '1ecd7fa752be61f5ee6437457c0fbce2',
        'redirect' => 'https://budandcarriage.com/callback/facebook',
    ],
    
    'google' => [
        'client_id' => '633088678246-tad4jm5nafckh74fg73pf49jn354dspd.apps.googleusercontent.com',
        'client_secret' => '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',
        'redirect' => 'https://budandcarriage.com/auth/google/callback',
    ],
];
