<?php

namespace MennenOnline\Shopware5ApiConnector\Endpoints;

use MennenOnline\Shopware5ApiConnector\Enums\EndpointEnum;
use MennenOnline\Shopware5ApiConnector\Models\BaseResponseModel;
use MennenOnline\Shopware5ApiConnector\Models\Endpoints\PaymentMethod\PaymentMethodListModel;
use MennenOnline\Shopware5ApiConnector\Models\Endpoints\PaymentMethod\PaymentMethodSingleModel;
use MennenOnline\Shopware5ApiConnector\Shopware5ApiConnector;

class PaymentMethodEndpoint extends Endpoint
{
    public function initialize(?string $url = null, ?string $username = null, ?string $password = null): Shopware5ApiConnector
    {
        $this->endpoint = EndpointEnum::PAYMENT_METHODS;

        return parent::initialize($url, $username, $password);
    }

    public function getAll(?int $limit = null): BaseResponseModel {
        $this->responseModel = PaymentMethodListModel::class;

        return parent::getAll($limit);
    }

    public function getSingle(int|string $id): BaseResponseModel {
        $this->responseModel = PaymentMethodSingleModel::class;

        return parent::getSingle($id);
    }
}
