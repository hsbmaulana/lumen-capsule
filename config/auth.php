<?php

return [

    'defaults' => [ 'guard' => 'api', 'passwords' => 'default', ],
    'password_timeout' => 7200,

    'guards' => [

        'api' => [

            'driver' => 'token',
            'provider' => 'eloquent',
            'hash' => false,

            'input_key' => 'token',
            'storage_key' => 'token',
        ],

        'web' => [],
    ],

    'passwords' => [

        'default' => [

            'provider' => 'eloquent',
            'table' => 'resetters',
            'expire' => 8,
            'throttle' => 120,
        ],
    ],



    'providers' => [

        'eloquent' => [ 'driver' => 'eloquent', 'model' => App\Models\User::class, ],
        'database' => [ 'driver' => 'database', 'table' => 'users', ],
    ],
];