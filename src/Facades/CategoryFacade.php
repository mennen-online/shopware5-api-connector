<?php

namespace MennenOnline\Shopware5ApiConnector\Facades;

use Illuminate\Support\Facades\Facade;
use MennenOnline\Shopware5ApiConnector\Endpoints\CategoryEndpoint;

class CategoryFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return CategoryEndpoint::class;
    }
}
