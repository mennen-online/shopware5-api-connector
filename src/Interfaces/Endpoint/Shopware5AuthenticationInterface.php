<?php

namespace MennenOnline\Shopware5ApiConnector\Interfaces\Endpoint;

use MennenOnline\Shopware5ApiConnector\Models\AuthResponseModel;

interface Shopware5AuthenticationInterface
{
    public function oAuthToken(): AuthResponseModel;
}
