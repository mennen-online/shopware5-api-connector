<?php

namespace MennenOnline\Shopware5ApiConnector\Facades;

use Illuminate\Support\Facades\Facade;
use MennenOnline\Shopware5ApiConnector\Endpoints\GenerateArticleImageEndpoint;

class GenerateArticleImageFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return GenerateArticleImageEndpoint::class;
    }
}
