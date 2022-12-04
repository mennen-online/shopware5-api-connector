<?php

namespace MennenOnline\Shopware5ApiConnector\Facades;

use Illuminate\Support\Facades\Facade;
use MennenOnline\Shopware5ApiConnector\Endpoints\CountryEndpoint;

class CountryFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return CountryEndpoint::class;
    }
}
