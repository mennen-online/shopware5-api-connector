<?php

namespace MennenOnline\Shopware5ApiConnector\Endpoints;

use MennenOnline\Shopware5ApiConnector\Enums\EndpointEnum;
use MennenOnline\Shopware5ApiConnector\Shopware5ApiConnector;

class CountryEndpoint extends Shopware5ApiConnector
{
    public function initialize(?string $url = null, ?string $username = null, ?string $password = null): Shopware5ApiConnector
    {
        $this->endpoint = EndpointEnum::COUNTRIES;

        return parent::initialize($url, $username, $password); // TODO: Change the autogenerated stub
    }
}