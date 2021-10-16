<?php

return [

    'name' => (string) env('APP_NAME', 'lumen'),
    'version' => (integer) env('APP_VERSION', 1),
    'url' => (string) env('APP_URL', 'http://localhost'),

    'env' => (string) env('APP_ENV', 'production'),
    'debug' => (bool) env('APP_DEBUG', false),

    'timezone' => (string) env('APP_TIMEZONE', 'UTC'),

    'locale' => 'en',
    'fallback_locale' => 'en',
    'faker_locale' => 'en_US',

    'key' => (string) env('APP_KEY'),
    'cipher' => 'AES-256-CBC',
];