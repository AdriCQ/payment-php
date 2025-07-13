<?php

namespace Tests;

use AdriCQ\Payment\Providers\PaymentServiceProvider;
use Dotenv\Dotenv;
use Orchestra\Testbench\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        if (file_exists(__DIR__ . '/../.env')) {
            echo 'Loading .env' . PHP_EOL;
            $dotenv = Dotenv::createImmutable(__DIR__ . '/../');
            $dotenv->load();
        }
    }

    protected function getPackageProviders($app): array
    {
        return [
            PaymentServiceProvider::class,
        ];
    }
}
