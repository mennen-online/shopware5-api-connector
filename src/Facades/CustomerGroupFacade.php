<?php

namespace MennenOnline\Shopware5ApiConnector\Facades;

use Illuminate\Support\Facades\Facade;
use MennenOnline\Shopware5ApiConnector\Endpoints\CustomerGroupEndpoint;

class CustomerGroupFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return CustomerGroupEndpoint::class;
    }
}