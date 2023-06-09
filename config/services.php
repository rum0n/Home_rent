<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, SparkPost and others. This file provides a sane default
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

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    /*
   |--------------------------------------------------------------------------
   | Facebook
   |--------------------------------------------------------------------------
   */

    'facebook' => [
        'client_id' => '2472475429748606',     // facebook app id
        'client_secret' => '070bc2ac09f9a29be78e498e39fe7b20', // facebook app password
        'redirect' => 'http://localhost:8000/login/facebook/callback',
    ],

    /*
    |--------------------------------------------------------------------------
    | Google
    |--------------------------------------------------------------------------
    */

    'google' => [
        'client_id' => '779515939937-e9visd0ghtevcqkhjbb6q1i5hag5ibd3.apps.googleusercontent.com',
        'client_secret' => '6KrJRpPIG9KvDs1K5_Y5GEIi',
        'redirect' => 'http://localhost:8000/login/google/callback',
    ],


];
