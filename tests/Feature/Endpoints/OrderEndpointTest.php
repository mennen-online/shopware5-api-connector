<?php

namespace MennenOnline\Shopware5ApiConnector\Tests\Feature\Endpoints;

use Illuminate\Support\Facades\Http;
use MennenOnline\Shopware5ApiConnector\Facades\OrderFacade;
use MennenOnline\Shopware5ApiConnector\Models\BaseResponseModel;
use MennenOnline\Shopware5ApiConnector\Models\Endpoints\Order\OrderListModel;
use MennenOnline\Shopware5ApiConnector\Models\Endpoints\Order\OrderSingleModel;
use MennenOnline\Shopware5ApiConnector\Tests\BaseTest;

class OrderEndpointTest extends BaseTest
{
    /**
     * @test
     */
    public function it_can_retrieve_a_list_of_orders() {
        $response = file_get_contents(__DIR__.'/../Responses/Order/list.json');

        Http::fake([
            '*' => Http::response((array)json_decode($response))
        ]);

        $result = OrderFacade::initialize('http://localhost', 'test', 'test')->getAll();

        $this->assertInstanceOf(BaseResponseModel::class, $result);

        $this->assertInstanceOf(OrderListModel::class, $result->data->first());
    }

    /**
     * @test
     */
    public function it_can_retrieve_a_single_order() {
        $response = file_get_contents(__DIR__.'/../Responses/Order/single.json');

        Http::fake([
            '*' => Http::response((array)json_decode($response))
        ]);

        $result = OrderFacade::initialize('http://localhost', 'test', 'test')->getSingle(1);

        $this->assertInstanceOf(BaseResponseModel::class, $result);

        $this->assertInstanceOf(OrderSingleModel::class, $result->data);
    }
}