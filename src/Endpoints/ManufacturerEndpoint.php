<?php

namespace MennenOnline\Shopware5ApiConnector\Endpoints;

use MennenOnline\Shopware5ApiConnector\Enums\EndpointEnum;
use MennenOnline\Shopware5ApiConnector\Models\BaseResponseModel;
use MennenOnline\Shopware5ApiConnector\Models\Endpoints\Manufacturer\ManufacturerListModel;
use MennenOnline\Shopware5ApiConnector\Models\Endpoints\Manufacturer\ManufacturerSingleModel;
use MennenOnline\Shopware5ApiConnector\Shopware5ApiConnector;

class ManufacturerEndpoint extends Endpoint
{
    public function initialize(?string $url = null, ?string $username = null, ?string $password = null): Shopware5ApiConnector
    {
        $this->endpoint = EndpointEnum::MANUFACTURERS;

        return parent::initialize($url, $username, $password);
    }

    public function getAll(?int $limit = null): BaseResponseModel {
        $this->responseModel = ManufacturerListModel::class;

        return parent::getAll($limit);
    }

    public function getSingle(int|string $id): BaseResponseModel {
        $this->responseModel = ManufacturerSingleModel::class;

        return parent::getSingle($id);
    }
}
