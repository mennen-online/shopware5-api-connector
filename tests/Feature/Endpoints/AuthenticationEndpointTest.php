<?php

namespace MennenOnline\Shopware5ApiConnector\Tests\Feature\Endpoints;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use MennenOnline\Shopware5ApiConnector\Endpoints\AuthenticationEndpoint;
use MennenOnline\Shopware5ApiConnector\Endpoints\Endpoint;
use MennenOnline\Shopware5ApiConnector\Enums\EndpointEnum;
use MennenOnline\Shopware5ApiConnector\Models\AuthResponseModel;
use MennenOnline\Shopware5ApiConnector\Shopware5ApiConnector;
use MennenOnline\Shopware5ApiConnector\Tests\BaseTest;

class AuthenticationEndpointTest extends BaseTest
{
    protected function setUp(): void {
        parent::setUp();
    }

    /**
     * @test
     */
    public function it_returns_an_instance_of_authentication_endpoint() {
        $instance = new Endpoint();

        $this->assertInstanceOf(Endpoint::class, $instance);

        $instance = new Endpoint();

        $this->assertInstanceOf(Endpoint::class, $instance);
    }
}