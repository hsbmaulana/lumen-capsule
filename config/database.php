<?php

return [

    'default' => env('DB_CONNECTION', 'mysql'),
    'migrations' => 'migrations',

    'connections' => [

        'mysql' => [

            'driver' => 'mysql',
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', 3306),
            'database' => env('DB_DATABASE', ''),
            'prefix' => env('DB_PREFIX', ''),
            'username' => env('DB_USERNAME', ''),
            'password' => env('DB_PASSWORD', ''),

            'timezone' => (new DateTime('now', new DateTimeZone((string) env('APP_TIMEZONE', 'UTC'))))->format('P'),
            'engine' => 'InnoDB',
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'strict' => true,
            'unix_socket' => '',
        ],

        'sqlite' => [

            'driver' => 'sqlite',
            'database' => env('DB_DATABASE', database_path('database.sqlite')),
            'prefix' => env('DB_PREFIX', ''),
        ],
    ],

    'redis' => [

        'client' => env('MEMORY_CLIENT', 'phpredis'),
        'options' => [ 'cluster' => false, ],

        'clusters' => [],

        'default' => [

            'scheme' => 'tcp',
            'host' => env('MEMORY_HOST', '127.0.0.1'),
            'port' => env('MEMORY_PORT', 6379),
            'password' => env('MEMORY_PASSWORD', null),
            'database' => 0,
        ],

        'cache' => [

            'scheme' => 'tcp',
            'host' => env('MEMORY_HOST', '127.0.0.1'),
            'port' => env('MEMORY_PORT', 6379),
            'password' => env('MEMORY_PASSWORD', null),
            'database' => env('MEMORY_CACHE_DB', 1),
        ],

        'queue' => [

            'scheme' => 'tcp',
            'host' => env('MEMORY_HOST', '127.0.0.1'),
            'port' => env('MEMORY_PORT', 6379),
            'password' => env('MEMORY_PASSWORD', null),
            'database' => env('MEMORY_QUEUE_DB', 2),
        ],

        'broadcast' => [

            'scheme' => 'tcp',
            'host' => env('MEMORY_HOST', '127.0.0.1'),
            'port' => env('MEMORY_PORT', 6379),
            'password' => env('MEMORY_PASSWORD', null),
            'database' => env('MEMORY_BROADCAST_DB', 3),
        ],
    ],
];
