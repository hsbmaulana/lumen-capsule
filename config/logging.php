<?php

return [

    'default' => env('LOG_CHANNEL', 'stack'),

    'channels' => [

        'stack' => [ 'driver' => 'stack', 'channels' => [ 'single', 'daily', ], ],

        'single' => [ 'driver' => 'single', 'level' => env('APP_LOG_LEVEL', 'debug'), 'path' => storage_path('log/report.log'), ],
        'daily' => [ 'driver' => 'daily', 'level' => env('APP_LOG_LEVEL', 'debug'), 'path' => storage_path('log/report.log'), 'days' => 8, ],
        'emergency' => [ 'path' => storage_path('log/report.log'), ],

        'errorlog' => [ 'driver' => 'errorlog', 'level' => env('APP_LOG_LEVEL', 'debug'), ],
        'syslog' => [ 'driver' => 'syslog', 'level' => env('APP_LOG_LEVEL', 'debug'), ],
    ],
];