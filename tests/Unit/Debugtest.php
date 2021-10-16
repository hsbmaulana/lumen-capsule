<?php

namespace Tests\Unit;

use Tests\TestCase;

class Debugtest extends TestCase
{
    /**
     * @return void
     * @group Debug
     * @test
     */
    public function listRoute()
    {
        $this->explore(__METHOD__, $this->app['router']->getRoutes());
    }

    /**
     * @return void
     * @group Debug
     * @test
     */
    public function generateKey()
    {
        $key = 'base64' . ':' . base64_encode($this->app['encrypter']->generateKey($this->app['config']['app.cipher']));

        $this->explore(__METHOD__, $key);
    }
}