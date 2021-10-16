<?php

namespace App\Providers;

use Laravel\Lumen\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * @var array
     */
    protected $listen = [];

    /**
     * @return void
     */
    // public function register() {}

    /**
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }
}