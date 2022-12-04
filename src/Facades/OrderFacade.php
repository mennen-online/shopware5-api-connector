<?php

namespace MennenOnline\Shopware5ApiConnector\Facades;

use Illuminate\Support\Facades\Facade;
use MennenOnline\Shopware5ApiConnector\Endpoints\OrderEndpoint;

class OrderFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return OrderEndpoint::class;
    }
}
