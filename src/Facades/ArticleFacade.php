<?php

namespace MennenOnline\Shopware5ApiConnector\Facades;

use Illuminate\Support\Facades\Facade;
use MennenOnline\Shopware5ApiConnector\Endpoints\ArticleEndpoint;
use MennenOnline\Shopware5ApiConnector\Models\BaseResponseModel;

/**
 * @method BaseResponseModel getAll(int $limit = null)
 * @method BaseResponseModel getSingle(int|string $id)
 */
class ArticleFacade extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return ArticleEndpoint::class;
    }
}
