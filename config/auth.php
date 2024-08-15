<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Defaults
    |--------------------------------------------------------------------------
    |
    | This option defines the default authentication "guard" and password
    | reset "broker" for your application. You may change these values
    | as required, but they're a perfect start for most applications.
    |
    */

    'defaults' => [
        'guard' => env('AUTH_GUARD', 'api'),  // Ensure 'AUTH_GUARD' is set in your .env
        'passwords' => env('AUTH_PASSWORD_BROKER', 'users'),  // Ensure 'AUTH_PASSWORD_BROKER' is set in your .env
    ],

    /*
    |--------------------------------------------------------------------------
    | Authentication Guards
    |--------------------------------------------------------------------------
    |
    | Define every authentication guard for your application.
    |
    */

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],
        'api' => [
            'driver' => 'jwt',  // Make sure this is set to 'jwt'
            'provider' => 'users',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Providers
    |--------------------------------------------------------------------------
    |
    | Define how the users are actually retrieved out of your database or other storage
    | system used by the application.
    |
    */

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => env('AUTH_MODEL', App\Models\User::class),  // Ensure 'AUTH_MODEL' is set in your .env
        ],

        // Optionally, you could use a database provider instead:
        // 'users' => [
        //     'driver' => 'database',
        //     'table' => 'users',
        // ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Resetting Passwords
    |--------------------------------------------------------------------------
    |
    | Configuration options for Laravel's password reset functionality.
    |
    */

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => env('AUTH_PASSWORD_RESET_TOKEN_TABLE', 'password_reset_tokens'),  // Ensure 'AUTH_PASSWORD_RESET_TOKEN_TABLE' is set in your .env
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Password Confirmation Timeout
    |--------------------------------------------------------------------------
    |
    | The amount of seconds before a password confirmation window expires.
    |
    */

    'password_timeout' => env('AUTH_PASSWORD_TIMEOUT', 10800),  // Ensure 'AUTH_PASSWORD_TIMEOUT' is set in your .env

];
