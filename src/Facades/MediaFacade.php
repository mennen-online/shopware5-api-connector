<?php

namespace MennenOnline\Shopware5ApiConnector\Facades;

use Illuminate\Support\Facades\Facade;
use MennenOnline\Shopware5ApiConnector\Endpoints\CustomerEndpoint;
use MennenOnline\Shopware5ApiConnector\Endpoints\MediaEndpoint;

class MediaFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return MediaEndpoint::class;
    }
}
