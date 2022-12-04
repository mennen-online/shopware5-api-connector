<?php

namespace MennenOnline\Shopware5ApiConnector\Facades;

use Illuminate\Support\Facades\Facade;
use MennenOnline\Shopware5ApiConnector\Endpoints\CacheEndpoint;

class CacheFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return CacheEndpoint::class;
    }
}
