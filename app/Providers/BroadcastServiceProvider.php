<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class BroadcastServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function register() {}

    /**
     * @return void
     */
    public function boot()
    {
        $this->app['router']->group([ 'prefix' => 'api' . '/' . 'v' . config('app.version'), 'middleware' => [ 'cors', 'auth:api', ], ],

        function ($router) {

            $router->addRoute(['HEAD', 'GET', 'POST'], '/socket/auth', '\\'.\App\Http\Controllers\Auth::class.'@socket');
        });

        require base_path('routes/channel.php');
    }
}