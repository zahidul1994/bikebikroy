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
        'client_id' => '409011880745218', //Facebook API
        'client_secret' => '067514c7e74bf07ef5221b901b851a44', //Facebook Secret
        'redirect' => 'http://localhost/login/facebook/callback',
     ],

     'google' => [    
        'client_id' =>'309235388802-r0o7rp9a5n6rojr8ebubb2r4kj8i4ihf.apps.googleusercontent.com',  
        'client_secret' => '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',  
        'redirect' => 'http://localhost/login/google/callback',
      ],
      

];
