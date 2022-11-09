<?php

namespace MennenOnline\Shopware5ApiConnector\Tests;

use Illuminate\Foundation\Bootstrap\LoadEnvironmentVariables;
use Illuminate\Support\Facades\Http;
use MennenOnline\Shopware5ApiConnector\Enums\EndpointEnum;
use MennenOnline\Shopware5ApiConnector\Shopware5ApiConnectorServiceProvider;
use Orchestra\Testbench\TestCase;

class BaseTest extends TestCase
{
    protected string $testUrl = 'http://localhost';

    protected int $expires_in = 600;

    protected $loadEnvironmentVariables = true;

    protected function setUp(): void {
        parent::setUp();
    }

    protected function defineEnvironment($app) {
        parent::getEnvironmentSetUp($app);

        $app->useEnvironmentPath(__DIR__.'/..');

        $app->bootstrapWith([LoadEnvironmentVariables::class]);

        $app['config']->set('shopware5', [
            'url' => env('SW5_HOST', $this->testUrl),
            'client_id' => env('SW5_CLIENT_ID'),
            'client_secret' => env('SW5_CLIENT_SECRET')
        ]);
    }

    protected function getPackageProviders($app) {
        return [
            Shopware5ApiConnectorServiceProvider::class
        ];
    }
}