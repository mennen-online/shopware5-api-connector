<?php

namespace MennenOnline\Shopware5ApiConnector\Endpoints;

use MennenOnline\Shopware5ApiConnector\Enums\EndpointEnum;
use MennenOnline\Shopware5ApiConnector\Shopware5ApiConnector;

class CustomerEndpoint extends Shopware5ApiConnector
{
    public function initialize(?string $url = null, ?string $username = null, ?string $password = null, ?string $model = null): Shopware5ApiConnector
    {
        $this->responseModel = $model;

        $this->endpoint = EndpointEnum::CUSTOMERS;

        return parent::initialize($url, $username, $password); // TODO: Change the autogenerated stub
    }
}
