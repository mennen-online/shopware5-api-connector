<?php

namespace MennenOnline\Shopware5ApiConnector\Facades;

use Illuminate\Support\Facades\Facade;
use MennenOnline\Shopware5ApiConnector\Endpoints\VariantEndpoint;

class VariantFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return VariantEndpoint::class;
    }
}
