<?php

namespace MennenOnline\Shopware5ApiConnector\Endpoints;

use MennenOnline\Shopware5ApiConnector\Enums\EndpointEnum;
use MennenOnline\Shopware5ApiConnector\Models\BaseResponseModel;
use MennenOnline\Shopware5ApiConnector\Models\Endpoints\Article\ArticleListModel;
use MennenOnline\Shopware5ApiConnector\Models\Endpoints\Article\ArticleSingleModel;
use MennenOnline\Shopware5ApiConnector\Shopware5ApiConnector;

class ArticleEndpoint extends Endpoint
{
    public function initialize(?string $url = null, ?string $username = null, ?string $password = null, ?string $model = null): Shopware5ApiConnector
    {
        $this->endpoint = EndpointEnum::ARTICLES;

        return parent::initialize($url, $username, $password);
    }

    public function getAll(?int $limit = null): BaseResponseModel {
        return parent::getAll($limit);
    }

    public function getSingle(int|string $id): BaseResponseModel {
        return parent::getSingle($id);
    }
}
