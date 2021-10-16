<?php

return [

    'default' => env('FILESYSTEM_DRIVER', 'local'),
    'cloud' => env('CLOUDSYSTEM_DRIVER', null),

    'disks' => [

        'local' => [

            'driver' => 'local', 'visibility' => 'public',

            'root' => storage_path('disk/public'),
            'url' => env('APP_URL') . '/storage',

            'permissions' => [

                'file' => [ 'public' => 0644, 'private' => 0600, ],
                'dir' => [ 'public' => 0755, 'private' => 0700, ],
            ],

            'cache' => [ 'store' => 'redis', 'prefix' => 'disk', 'expire' => 800, ],
        ],
    ],
];