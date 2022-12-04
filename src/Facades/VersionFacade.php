<?php

namespace MennenOnline\Shopware5ApiConnector\Facades;

use Illuminate\Support\Facades\Facade;
use MennenOnline\Shopware5ApiConnector\Endpoints\VersionEndpoint;

class VersionFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return VersionEndpoint::class;
    }
}
