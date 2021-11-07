<?php

namespace Tests\Integration;

use App\Models\User;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use Tests\TestCase;

class Confirmationtest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @var array
     */
    protected $headers;

    /**
     * @var array
     */
    protected $parameters;

    /**
     * @var array
     */
    protected $querystring;

    /**
     * @var array
     */
    protected $inputsform;

    /**
     * @return void
     */
    protected function setUp() : void
    {
        parent::setUp();
        $this->setUpTranslation('id');
        $this->setUpPolicy();
        $this->setUpEventListener();
        $this->setUpRoute();

        $this->headers = [];
        $this->parameters = []; $this->querystring = []; $this->inputsform = [];
    }

    /**
     * @return void
     */
    protected function tearDown() : void
    {
        parent::tearDown();
    }

    /**
     * @param string $language
     * @return void
     */
    public function setUpTranslation($language)
    {
        $this->app['translator']->setLocale($language);

        $this->app['translator']->addLines([ 'notification.activation.title' => 'Your account has been activated successfully.', ], 'en');
        $this->app['translator']->addLines([ 'notification.activation.mail.subject' => $this->app['config']['app.name'] . ' - ' . 'Your Account Activation Information', ], 'en');
        $this->app['translator']->addLines([ 'notification.activation.mail.object' => 'This is a confirmation that your account (:id - :username) has been activated.', ], 'en');
        $this->app['translator']->addLines([ 'notification.deactivation.mail.subject' => $this->app['config']['app.name'] . ' - ' . 'Your Account Deactivation Information', ], 'en');
        $this->app['translator']->addLines([ 'notification.deactivation.mail.object' => 'Your account is temporary in deactivate mode.', ], 'en');

        $this->app['translator']->addLines([ 'notification.activation.title' => 'Akun anda telah berhasil diaktifkan.', ], 'id');
        $this->app['translator']->addLines([ 'notification.activation.mail.subject' => $this->app['config']['app.name'] . ' - ' . 'Informasi Aktivasi Akun Anda', ], 'id');
        $this->app['translator']->addLines([ 'notification.activation.mail.object' => 'Ini adalah sebuah informasi bahwa akun anda (:id - :username) telah berhasil diaktifkan.', ], 'id');
        $this->app['translator']->addLines([ 'notification.deactivation.mail.subject' => $this->app['config']['app.name'] . ' - ' . 'Informasi Deaktivasi Akun Anda', ], 'id');
        $this->app['translator']->addLines([ 'notification.deactivation.mail.object' => 'Akun anda sementara dalam mode deaktivasi.', ], 'id');
    }

    /**
     * @return void
     */
    public function setUpPolicy()
    {
        \Illuminate\Support\Facades\Gate::define('activateable', [ \Tests\Integration\Policies\Auth\Setting::class, 'activate', ]);
        \Illuminate\Support\Facades\Gate::define('deactivateable', [ \Tests\Integration\Policies\Auth\Setting::class, 'deactivate', ]);
    }

    /**
     * @return void
     */
    public function setUpEventListener()
    {
        \Illuminate\Support\Facades\Event::listen(\Tests\Integration\Events\Auth\Activated::class, \Tests\Integration\Listeners\Auth\Activated\Notif::class);
        \Illuminate\Support\Facades\Event::listen(\Tests\Integration\Events\Auth\Deactivated::class, \Tests\Integration\Listeners\Auth\Deactivated\Notif::class);
    }

    /**
     * @return void
     */
    public function setUpRoute()
    {
        \Illuminate\Support\Facades\Broadcast::channel('auth.{id}', function ($auth, $id) { return $auth->id == $id; });
        \Illuminate\Support\Facades\Broadcast::channel('user.{id}', function ($auth, $id) { return $auth->id != $id; });

        \Illuminate\Support\Facades\Route::post('activation', [ 'middleware' => 'auth', 'as' => 'auth.activation', 'uses' => 'Tests\Integration\Http\Controllers\Auth\Setting\Activation@store', ]);
        \Illuminate\Support\Facades\Route::post('deactivation', [ 'middleware' => 'auth', 'as' => 'auth.deactivation', 'uses' => 'Tests\Integration\Http\Controllers\Auth\Setting\Deactivation@store', ]);
    }

    /**
     * @return void
     */
    public function testActivation()
    {
        $this->actingAs(User::factory()->create(), 'api')->post(route('auth.activation'), $this->inputsform, $this->headers)->seeStatusCode(201);
    }

    /**
     * @return void
     * @depends testActivation
     */
    public function testDeactivation()
    {
        $this->actingAs(User::factory()->create(), 'api')->post(route('auth.deactivation'), $this->inputsform, $this->headers)->seeStatusCode(201);
    }
}