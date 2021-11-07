<?php

/** @var \Laravel\Lumen\Routing\Router $router */

$router->group([ 'as' => 'auth', 'namespace' => 'Auth', 'prefix' => 'auth', 'middleware' => 'auth', ], function () use ($router) {

    $router->group([ 'namespace' => 'Setting', 'prefix' => 'setting', ], function () use ($router) {

        $router->post('activation', [ 'as' => 'activation', 'uses' => 'Activation@store', ]);
        $router->post('deactivation', [ 'as' => 'deactivation', 'uses' => 'Deactivation@store', ]);
    });
});