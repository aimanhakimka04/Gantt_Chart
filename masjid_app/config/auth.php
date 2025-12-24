<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Defaults
    |--------------------------------------------------------------------------
    | menetapkan 'web' (Committee) sebagai default guard.
    */

    'defaults' => [
        'guard' => 'web', 
        'passwords' => 'committees',
    ],

    /*
    |--------------------------------------------------------------------------
    | Authentication Guards
    |--------------------------------------------------------------------------
    | 'web' untuk AJK/Committee.
    | 'participant' untuk Orang Awam.
    */

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'committees', // Link ke provider committees
        ],

        'committee' => [
            'driver' => 'session',
            'provider' => 'committees',
        ],

        // 2. Guard Khas untuk Participant (Orang Awam)
        'participant' => [
            'driver' => 'session',
            'provider' => 'participants',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Providers
    |--------------------------------------------------------------------------
    | Menghubungkan guard dengan Model masing-masing.
    */

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],

        // Pastikan bahagian ini wujud
        'committees' => [
            'driver' => 'eloquent',
            'model' => App\Models\Committee::class, // Pastikan Model Committee wujud
        ],

        'participants' => [
            'driver' => 'eloquent',
            'model' => App\Models\Participant::class,
        ],
    ],
    /*
    |--------------------------------------------------------------------------
    | Resetting Passwords
    |--------------------------------------------------------------------------
    */

    'passwords' => [
        'committees' => [
            'provider' => 'committees',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],

        'participants' => [
            'provider' => 'participants',
            'table' => 'password_reset_tokens', // Boleh guna table token yang sama
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => 10800,

];