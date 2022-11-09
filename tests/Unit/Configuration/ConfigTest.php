<?php

namespace MennenOnline\Shopware5ApiConnector\Tests\Configuration;

use MennenOnline\Shopware5ApiConnector\Tests\BaseTest;

class ConfigTest extends BaseTest
{
    /**
     * @test
     */
    public function it_has_shopware6_url() {
        $this->assertNotNull(config('shopware5.url'));
    }

    /**
     * @test
     */
    public function it_has_shopware6_client_id() {
        $this->assertNotNull(config('shopware5.client_id'));
    }

    /**
     * @test
     */
    public function it_has_shopware6_client_secret() {
        $this->assertNotNull(config('shopware5.client_secret'));
    }
}