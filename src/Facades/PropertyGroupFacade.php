<?php

namespace MennenOnline\Shopware5ApiConnector\Facades;

use Illuminate\Support\Facades\Facade;
use MennenOnline\Shopware5ApiConnector\Endpoints\PropertyGroupEndpoint;

class PropertyGroupFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return PropertyGroupEndpoint::class;
    }
}
