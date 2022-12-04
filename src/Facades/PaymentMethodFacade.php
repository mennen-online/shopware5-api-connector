<?php

namespace MennenOnline\Shopware5ApiConnector\Facades;

use Illuminate\Support\Facades\Facade;
use MennenOnline\Shopware5ApiConnector\Endpoints\PaymentMethodEndpoint;

class PaymentMethodFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return PaymentMethodEndpoint::class;
    }
}
