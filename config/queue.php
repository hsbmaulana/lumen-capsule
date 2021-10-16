<?php

return [

    'default' => env('QUEUE_CONNECTION', 'redis'),

    'connections' => [

        'sync' => [ 'driver' => 'sync', ],
        'database' => [ 'driver' => 'database', 'table' => 'queues', 'queue' => 'none', 'retry_after' => 88, ],
        'redis' => [ 'driver' => 'redis', 'connection' => 'queue', 'queue' => 'none', 'retry_after' => 88, 'block_for' => 5, ],
    ],

    'failed' => [ 'driver' => 'database-uuids', 'database' => env('DB_CONNECTION', 'mysql'), 'table' => 'failqueues', ],
];