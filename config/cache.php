<?php

return [

    'default' => env('CACHE_DRIVER', 'redis'),

    'prefix' => env('APP_NAME') . '_' . 'cache',

    'stores' => [

        'array' => [ 'driver' => 'array', 'serialize' => false, ],
        'database' => [ 'driver' => 'database', 'connection' => env('DB_CONNECTION', 'mysql'), 'table' => 'caches', ],
        'redis' => [ 'driver' => 'redis', 'connection' => env('CACHE_DB_CONNECTION'), ],
    ],
];