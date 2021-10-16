<?php

return [

    'default' => env('BROADCAST_DRIVER', 'redis'),

    'connections' => [

        'pusher' => [

            'driver' => 'pusher',
            'app_id' => env('PUSHER_ID'), 'key' => env('PUSHER_KEY'),
            'secret' => env('PUSHER_SECRET'),
            'options' => [ 'cluster' => env('PUSHER_CLUSTER'), 'use' . 'TLS' => true, ],
        ],

        'redis' => [

            'driver' => 'redis',
            'connection' => 'broadcast',
        ],

        'log' => [

            'driver' => 'log',
        ],
    ],
];