<?php

namespace MennenOnline\Shopware5ApiConnector\Endpoints;

use MennenOnline\Shopware5ApiConnector\Enums\EndpointEnum;
use MennenOnline\Shopware5ApiConnector\Models\BaseResponseModel;
use MennenOnline\Shopware5ApiConnector\Shopware5ApiConnector;
use MennenOnline\Shopware5ApiConnector\Models\Endpoints\Address\AddressListModel;
use MennenOnline\Shopware5ApiConnector\Models\Endpoints\Address\AddressSingleModel;

final class AddressEndpoint extends Endpoint
{
    public function initialize(?string $url = null, ?string $username = null, ?string $password = null): Shopware5ApiConnector
    {
        $this->endpoint = EndpointEnum::ADDRESSES;

        return parent::initialize($url, $username, $password);
    }

    public function getAll(?int $limit = null): BaseResponseModel {
        $this->responseModel = AddressListModel::class;
        return parent::getAll($limit);
    }

    public function getSingle(int|string $id): BaseResponseModel {
        $this->responseModel = AddressSingleModel::class;
        return parent::getSingle($id);
    }
}
