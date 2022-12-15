<?php

namespace MennenOnline\Shopware5ApiConnector\Endpoints;

use MennenOnline\Shopware5ApiConnector\Enums\EndpointEnum;
use MennenOnline\Shopware5ApiConnector\Models\BaseResponseModel;
use MennenOnline\Shopware5ApiConnector\Models\Endpoints\Cache\CacheListModel;
use MennenOnline\Shopware5ApiConnector\Models\Endpoints\Cache\CacheSingleModel;
use MennenOnline\Shopware5ApiConnector\Shopware5ApiConnector;

class CacheEndpoint extends Endpoint
{
    public function initialize(?string $url = null, ?string $username = null, ?string $password = null): Shopware5ApiConnector
    {
        $this->endpoint = EndpointEnum::CACHE;

        return parent::initialize($url, $username, $password);
    }

    public function getAll(?int $limit = null): BaseResponseModel {
        $this->responseModel = CacheListModel::class;

        return parent::getAll($limit);
    }

    public function getSingle(int|string $id): BaseResponseModel {
        $this->responseModel = CacheSingleModel::class;

        return parent::getSingle($id);
    }
}
