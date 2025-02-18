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

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'resend' => [
        'key' => env('RESEND_KEY'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    'oebb' => [
        'station_id' => env('OEBB_STATION_ID', '8101590'),
        'station_name' => env('OEBB_STATION_NAME'),
        'hidden_tracks' => env('OEBB_HIDDEN_TRACKS'),
        'offset_minutes' => env('OEBB_SCHEDULE_OFFSET_MINUTES', 15),
        'refresh_every_minutes' => env('OEBB_REFRESH_EVERY_MINUTES', 15),
    ],
];
