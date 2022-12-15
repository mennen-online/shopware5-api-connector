<?php

namespace Feature\Endpoints;

use Illuminate\Support\Facades\Http;
use MennenOnline\Shopware5ApiConnector\Facades\CustomerGroupFacade;
use MennenOnline\Shopware5ApiConnector\Models\BaseResponseModel;
use MennenOnline\Shopware5ApiConnector\Models\Endpoints\CustomerGroup\CustomerGroupListModel;
use MennenOnline\Shopware5ApiConnector\Models\Endpoints\CustomerGroup\CustomerGroupSingleModel;
use MennenOnline\Shopware5ApiConnector\Tests\BaseTest;

class CustomerGroupEndpointTest extends BaseTest
{
    /**
     * @test
     */
    public function it_can_retrieve_a_list_of_customer_group() {
        $response = file_get_contents(__DIR__.'/../Responses/CustomerGroup/list.json');

        Http::fake([
            '*' => Http::response((array)json_decode($response))
        ]);

        $result = CustomerGroupFacade::initialize('http://localhost', 'test', 'test')->getAll();

        $this->assertInstanceOf(BaseResponseModel::class, $result);

        $this->assertInstanceOf(CustomerGroupListModel::class, $result->data->first());
    }

    /**
     * @test
     */
    public function it_can_retrieve_a_single_customer_group() {
        $response = file_get_contents(__DIR__.'/../Responses/CustomerGroup/single.json');

        Http::fake([
            '*' => Http::response((array)json_decode($response))
        ]);

        $result = CustomerGroupFacade::initialize('http://localhost', 'test', 'test')->getSingle(1);

        $this->assertInstanceOf(BaseResponseModel::class, $result);

        $this->assertInstanceOf(CustomerGroupSingleModel::class, $result->data);
    }
}