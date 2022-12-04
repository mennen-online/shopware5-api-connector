<?php

namespace MennenOnline\Shopware5ApiConnector;

use Illuminate\Support\ServiceProvider;

class Shopware5ApiConnectorServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/shopware5.php' => config_path('shopware5.php'),
        ]);
    }

    public function register()
    {
    }
}
