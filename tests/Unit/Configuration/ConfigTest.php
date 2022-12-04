<?php

namespace MennenOnline\Shopware5ApiConnector\Tests\Configuration;

use MennenOnline\Shopware5ApiConnector\Tests\BaseTest;

class ConfigTest extends BaseTest
{
    /**
     * @test
     */
    public function it_has_shopware6_url()
    {
        $this->assertNotNull(config('shopware5.url'));
    }

    /**
     * @test
     */
    public function it_has_shopware5_username()
    {
        $this->assertNotNull(config('shopware5.username'));
    }

    /**
     * @test
     */
    public function it_has_shopware5_password()
    {
        $this->assertNotNull(config('shopware5.password'));
    }
}
