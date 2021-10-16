<?php

namespace Tests;

use Laravel\Lumen\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    /**
     * @return \Laravel\Lumen\Application
     */
    public function createApplication()
    {
        return require __DIR__ . '/../bootstrap/app.php';
    }

    /**
     * @param string $title
     * @param mixed $data
     * @return void
     */
    protected function explore($title, $data)
    {
        $this->expectNotToPerformAssertions();

        fwrite(STDOUT, "(" . $title . ")" . "\n" . var_export($data, true) . "\n\n");
    }
}