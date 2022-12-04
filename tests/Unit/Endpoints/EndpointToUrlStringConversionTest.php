<?php

namespace MennenOnline\Shopware5ApiConnector\Tests\Unit\Endpoints;

use MennenOnline\Shopware5ApiConnector\Enums\EndpointEnum;
use MennenOnline\Shopware5ApiConnector\Tests\BaseTest;

class EndpointToUrlStringConversionTest extends BaseTest
{
    /**
     * @test
     */
    public function it_can_convert_two_url_parts_in_camel_case_correctly()
    {
        $this->assertSame('customerGroups', EndpointEnum::convertEndpointToUrl(EndpointEnum::CUSTOMER_GROUPS));
    }

    /**
     * @test
     */
    public function it_can_convert_three_url_parts_in_camel_case_correctly()
    {
        $this->assertSame('generateArticleImages', EndpointEnum::convertEndpointToUrl(EndpointEnum::GENERATE_ARTICLE_IMAGES));
    }
}
