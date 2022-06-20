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
    'paygent' => [
        'env' => env('PAYGENT_ENV', 'local'),
        'merchant_id' => env('PAYGENT_MERCHANT_ID', ''),
        'connect_id' => env('PAYGENT_CONNECT_ID', ''),
        'connect_password' => env('PAYGENT_CONNECT_PASSWORD', ''),
        'token' => env('PAYGENT_TOKEN', ''), // 备注：此 token 为前台页面获取信用卡 token 时使用
        'pem' => app_path() . env('PAYGENT_PEM', ''),
        'crt' => app_path() . env('PAYGENT_CRT', ''),
        'telegram_version' => env('PAYGENT_TELEGRAM_VERSION', '1.0'),
    ]
];
