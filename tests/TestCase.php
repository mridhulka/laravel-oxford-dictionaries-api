<?php

namespace Mridhulka\LaravelOxfordDictionariesApi\Tests;

use Mridhulka\LaravelOxfordDictionariesApi\LaravelOxfordDictionariesApiServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    protected function getPackageProviders($app)
    {
        return [
            LaravelOxfordDictionariesApiServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        // perform environment setup
    }
}
