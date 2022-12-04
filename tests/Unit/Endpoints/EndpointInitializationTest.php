<?php

namespace MennenOnline\Shopware5ApiConnector\Tests\Unit\Endpoints;

use MennenOnline\Shopware5ApiConnector\Endpoints\Endpoint;
use MennenOnline\Shopware5ApiConnector\Enums\EndpointEnum;
use MennenOnline\Shopware5ApiConnector\Exceptions\NoShopware5CredentialsProvidedException;
use MennenOnline\Shopware5ApiConnector\Facades\AddressFacade;
use MennenOnline\Shopware5ApiConnector\Facades\ArticleFacade;
use MennenOnline\Shopware5ApiConnector\Facades\CacheFacade;
use MennenOnline\Shopware5ApiConnector\Facades\CountryFacade;
use MennenOnline\Shopware5ApiConnector\Facades\CustomerFacade;
use MennenOnline\Shopware5ApiConnector\Facades\CustomerGroupFacade;
use MennenOnline\Shopware5ApiConnector\Facades\GenerateArticleImageFacade;
use MennenOnline\Shopware5ApiConnector\Facades\ManufacturerFacade;
use MennenOnline\Shopware5ApiConnector\Facades\OrderFacade;
use MennenOnline\Shopware5ApiConnector\Facades\PaymentMethodFacade;
use MennenOnline\Shopware5ApiConnector\Facades\PropertyGroupFacade;
use MennenOnline\Shopware5ApiConnector\Facades\ShopFacade;
use MennenOnline\Shopware5ApiConnector\Facades\VariantFacade;
use MennenOnline\Shopware5ApiConnector\Facades\VersionFacade;
use MennenOnline\Shopware5ApiConnector\Shopware5ApiConnector;
use MennenOnline\Shopware5ApiConnector\Tests\BaseTest;

class EndpointInitializationTest extends BaseTest
{
    /**
     * @test
     */
    public function it_throws_an_exception_if_no_credentials_are_available()
    {
        $this->expectException(NoShopware5CredentialsProvidedException::class);

        (new Endpoint(endpoint: EndpointEnum::VERSION));
    }

    /**
     * @test
     */
    public function it_can_initialize_the_address_endpoint_correctly()
    {
        $instance = AddressFacade::initialize('http://localhost', 'test', 'test');

        $this->assertInstanceOf(Shopware5ApiConnector::class, $instance);

        $this->assertSame(EndpointEnum::ADDRESSES, $instance->getEndpoint());
    }

    /**
     * @test
     */
    public function it_can_initialize_the_article_endpoint_correctly()
    {
        $instance = ArticleFacade::initialize('http://localhost', 'test', 'test');

        $this->assertInstanceOf(Shopware5ApiConnector::class, $instance);

        $this->assertSame(EndpointEnum::ARTICLES, $instance->getEndpoint());
    }

    /**
     * @test
     */
    public function it_can_initialize_the_cache_endpoint_correctly()
    {
        $instance = CacheFacade::initialize('http://localhost', 'test', 'test');

        $this->assertInstanceOf(Shopware5ApiConnector::class, $instance);

        $this->assertSame(EndpointEnum::CACHE, $instance->getEndpoint());
    }

    /**
     * @test
     */
    public function it_can_initialize_the_country_endpoint_correctly()
    {
        $instance = CountryFacade::initialize('http://localhost', 'test', 'test');

        $this->assertInstanceOf(Shopware5ApiConnector::class, $instance);

        $this->assertSame(EndpointEnum::COUNTRIES, $instance->getEndpoint());
    }

    /**
     * @test
     */
    public function it_can_initialize_the_customer_endpoint_correctly()
    {
        $instance = CustomerFacade::initialize('http://localhost', 'test', 'test');

        $this->assertInstanceOf(Shopware5ApiConnector::class, $instance);

        $this->assertSame(EndpointEnum::CUSTOMERS, $instance->getEndpoint());
    }

    /**
     * @test
     */
    public function it_can_initialize_the_customer_group_endpoint_correctly()
    {
        $instance = CustomerGroupFacade::initialize('http://localhost', 'test', 'test');

        $this->assertInstanceOf(Shopware5ApiConnector::class, $instance);

        $this->assertSame(EndpointEnum::CUSTOMER_GROUPS, $instance->getEndpoint());
    }

    /**
     * @test
     */
    public function it_can_initialize_the_generate_article_image_endpoint_correctly()
    {
        $instance = GenerateArticleImageFacade::initialize('http://localhost', 'test', 'test');

        $this->assertInstanceOf(Shopware5ApiConnector::class, $instance);

        $this->assertSame(EndpointEnum::GENERATE_ARTICLE_IMAGES, $instance->getEndpoint());
    }

    /**
     * @test
     */
    public function it_can_initialize_the_manufacturer_endpoint_correctly()
    {
        $instance = ManufacturerFacade::initialize('http://localhost', 'test', 'test');

        $this->assertInstanceOf(Shopware5ApiConnector::class, $instance);

        $this->assertSame(EndpointEnum::MANUFACTURERS, $instance->getEndpoint());
    }

    /**
     * @test
     */
    public function it_can_initialize_the_order_endpoint_correctly()
    {
        $instance = OrderFacade::initialize('http://localhost', 'test', 'test');

        $this->assertInstanceOf(Shopware5ApiConnector::class, $instance);

        $this->assertSame(EndpointEnum::ORDERS, $instance->getEndpoint());
    }

    /**
     * @test
     */
    public function it_can_initialize_the_payment_method_endpoint_correctly()
    {
        $instance = PaymentMethodFacade::initialize('http://localhost', 'test', 'test');

        $this->assertInstanceOf(Shopware5ApiConnector::class, $instance);

        $this->assertSame(EndpointEnum::PAYMENT_METHODS, $instance->getEndpoint());
    }

    /**
     * @test
     */
    public function it_can_initialize_the_property_group_endpoint_correctly()
    {
        $instance = PropertyGroupFacade::initialize('http://localhost', 'test', 'test');

        $this->assertInstanceOf(Shopware5ApiConnector::class, $instance);

        $this->assertSame(EndpointEnum::PROPERTY_GROUPS, $instance->getEndpoint());
    }

    /**
     * @test
     */
    public function it_can_initialize_the_shop_endpoint_correctly()
    {
        $instance = ShopFacade::initialize('http://localhost', 'test', 'test');

        $this->assertInstanceOf(Shopware5ApiConnector::class, $instance);

        $this->assertSame(EndpointEnum::SHOPS, $instance->getEndpoint());
    }

    /**
     * @test
     */
    public function it_can_initialize_the_variant_endpoint_correctly()
    {
        $instance = VariantFacade::initialize('http://localhost', 'test', 'test');

        $this->assertInstanceOf(Shopware5ApiConnector::class, $instance);

        $this->assertSame(EndpointEnum::VARIANTS, $instance->getEndpoint());
    }

    /**
     * @test
     */
    public function it_can_initialize_the_version_endpoint_correctly()
    {
        $instance = VersionFacade::initialize('http://localhost', 'test', 'test');

        $this->assertInstanceOf(Shopware5ApiConnector::class, $instance);

        $this->assertSame(EndpointEnum::VERSION, $instance->getEndpoint());
    }
}
