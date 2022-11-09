<?php

namespace MennenOnline\Shopware5ApiConnector\Interfaces\Endpoint;

use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Auth;
use MennenOnline\Shopware5ApiConnector\Models\AuthResponseModel;

interface Shopware5AuthenticationInterface
{
    public function oAuthToken(): AuthResponseModel;
}