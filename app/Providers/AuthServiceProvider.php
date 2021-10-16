<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
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
        $this->authenticate();
        $this->authorize();
    }

    /**
     * @return void
     */
    protected function authenticate()
    {}

    /**
     * @return void
     */
    protected function authorize()
    {}
}