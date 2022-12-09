<?php

namespace MennenOnline\Shopware5ApiConnector\Endpoints;

use MennenOnline\Shopware5ApiConnector\Enums\EndpointEnum;
use MennenOnline\Shopware5ApiConnector\Models\BaseResponseModel;
use MennenOnline\Shopware5ApiConnector\Models\Endpoints\PropertyGroup\PropertyGroupListModel;
use MennenOnline\Shopware5ApiConnector\Models\Endpoints\PropertyGroup\PropertyGroupSingleModel;
use MennenOnline\Shopware5ApiConnector\Shopware5ApiConnector;

class PropertyGroupEndpoint extends Endpoint
{
    public function initialize(?string $url = null, ?string $username = null, ?string $password = null): Shopware5ApiConnector
    {
        $this->endpoint = EndpointEnum::PROPERTY_GROUPS;

        return parent::initialize($url, $username, $password);
    }

    public function getAll(?int $limit = null): BaseResponseModel {
        $this->responseModel = PropertyGroupListModel::class;

        return parent::getAll($limit);
    }

    public function getSingle(int|string $id): BaseResponseModel {
        $this->responseModel = PropertyGroupSingleModel::class;

        return parent::getSingle($id);
    }
}
