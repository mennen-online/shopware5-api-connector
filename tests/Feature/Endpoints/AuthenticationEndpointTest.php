<?php

namespace Feature\Endpoints;

use MennenOnline\Shopware5ApiConnector\Endpoints\Endpoint;
use MennenOnline\Shopware5ApiConnector\Tests\BaseTest;

class AuthenticationEndpointTest extends BaseTest
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    /**
     * @test
     */
    public function it_returns_an_instance_of_authentication_endpoint()
    {
        $instance = new Endpoint(
            username: 'test',
            password: 'test'
        );

        $this->assertInstanceOf(Endpoint::class, $instance);
    }

    /**
     * @test
     */
    public function it_initializes_the_connection_later()
    {
        $this->assertInstanceOf(Endpoint::class, new Endpoint(
            initializeLater: true
        ));
    }
}
