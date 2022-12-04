<?php

namespace MennenOnline\Shopware5ApiConnector\Facades;

use Illuminate\Support\Facades\Facade;
use MennenOnline\Shopware5ApiConnector\Endpoints\ManufacturerEndpoint;

class ManufacturerFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return ManufacturerEndpoint::class;
    }
}
