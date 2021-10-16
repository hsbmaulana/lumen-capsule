<?php

require_once __DIR__ . '/../vendor/autoload.php';

(new Laravel\Lumen\Bootstrap\LoadEnvironmentVariables(dirname(__DIR__)))->bootstrap();

/*
|--------------------------------------------------------------------------
| Register Engine Extension Key Value
|--------------------------------------------------------------------------
|
| List of application's values are INI, ENV, CONFIG.
|
*/

@ini_set('display_errors', env('APP_ENV') === 'production' ? 'Off' : 'On');
@ini_set('error_reporting', env('APP_ENV') === 'production' ? 'E_ALL & ~E_DEPRECATED & ~E_STRICT' : 'E_ALL');
@ini_set('date.timezone', env('APP_TIMEZONE', 'UTC'));
@ini_set('intl.default_locale', '');

/*
|--------------------------------------------------------------------------
| Create The Application
|--------------------------------------------------------------------------
|
| Here we will load the environment and create the application instance
| that serves as the central piece of this framework. We'll use this
| application as an "IoC" container and router for this framework.
|
*/

$application = new Laravel\Lumen\Application(dirname(__DIR__));

$application->withFacades(false);
// $application->withAliases([]);
$application->withEloquent();

/*
|--------------------------------------------------------------------------
| Register Container Bindings
|--------------------------------------------------------------------------
|
| Now we will register a few bindings in the service container.
| You may add your own bindings here if you like or you can make another file.
|
*/

$application->singleton(Illuminate\Contracts\Debug\ExceptionHandler::class, App\Exceptions\Handler::class);
$application->singleton(Illuminate\Contracts\Console\Kernel::class, App\Console\Kernel::class);

/*
|--------------------------------------------------------------------------
| Register Configuration Files
|--------------------------------------------------------------------------
|
| Now we will register configuration file. If the file exists in
| your configuration directory it will be loaded otherwise we'll load
| the default version. You may register other files below as needed.
|
*/

$application->configure('app');
$application->configure('logging');
$application->configure('view');

$application->configure('filesystems');
$application->configure('database');
$application->configure('mail');

$application->configure('cache');
$application->configure('queue');
$application->configure('broadcasting');

$application->configure('auth');

Illuminate\Support\Carbon::setLocale(config('app.locale', 'en'));

/*
|--------------------------------------------------------------------------
| Register Middleware
|--------------------------------------------------------------------------
|
| Next, we will register the middleware with the application. These can
| be global middleware that run before and after each request into a
| route or middleware that'll be assigned to some specific routes.
|
*/

// $application->middleware([ App\Http\Middleware\Global::class, ]);
$application->routeMiddleware(
[
    'auth' => App\Http\Middleware\Authentication::class,
    'can' => App\Http\Middleware\Authorization::class,

    'cors' => App\Http\Middleware\Cors::class,
    'signed' => Illuminate\Routing\Middleware\ValidateSignature::class,
    'throttle' => Illuminate\Routing\Middleware\ThrottleRequests::class,
    'throttle.inmemory' => Illuminate\Routing\Middleware\ThrottleRequestsWithRedis::class,
    'account.confirmed' => Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
    'password.confirm' => Illuminate\Auth\Middleware\RequirePassword::class,
]);

/*
|--------------------------------------------------------------------------
| Register Service Providers
|--------------------------------------------------------------------------
|
| Here we will register all of the application's service providers which
| are used to bind services into the container. Service providers are
| totally optional, so you are not required to uncomment this line.
|
*/

$application->register(Illuminate\Database\Eloquent\LegacyFactoryServiceProvider::class);
$application->register(Illuminate\Mail\MailServiceProvider::class); $application->alias('mail.manager', Illuminate\Mail\MailManager::class); $application->alias('mail.manager', Illuminate\Contracts\Mail\Factory::class); $application->alias('mailer', Illuminate\Mail\Mailer::class); $application->alias('mailer', Illuminate\Contracts\Mail\Mailer::class); $application->alias('mailer', Illuminate\Contracts\Mail\MailQueue::class);
$application->register(Illuminate\Redis\RedisServiceProvider::class);
$application->register(Illuminate\Notifications\NotificationServiceProvider::class);
$application->register(App\Providers\AuthServiceProvider::class);
$application->register(App\Providers\EventServiceProvider::class);
$application->register(App\Providers\BroadcastServiceProvider::class);

/*
|--------------------------------------------------------------------------
| Load The Application Routes
|--------------------------------------------------------------------------
|
| Next we will include the routes file so that they can all be added to
| the application. This will provide all of the URLs the application.
|
*/

$application->router->group([ 'prefix' => 'api' . '/' . 'v' . config('app.version'), 'namespace' => 'App\Http\Controllers', 'middleware' => 'cors', ], function ($router)
{
    require __DIR__ . '/../routes/api.php';
});

$application->router->group([ 'namespace' => 'App\Http\Controllers', ], function ($router)
{
    require __DIR__ . '/../routes/web.php';
});

return $application;