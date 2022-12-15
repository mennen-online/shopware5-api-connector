<?php

namespace MennenOnline\Shopware5ApiConnector\Tests\Feature\Endpoints;

use Illuminate\Support\Facades\Http;
use MennenOnline\Shopware5ApiConnector\Facades\ShopFacade;
use MennenOnline\Shopware5ApiConnector\Models\BaseResponseModel;
use MennenOnline\Shopware5ApiConnector\Models\Endpoints\Shop\ShopListModel;
use MennenOnline\Shopware5ApiConnector\Models\Endpoints\Shop\ShopSingleModel;
use MennenOnline\Shopware5ApiConnector\Tests\BaseTest;

class ShopEndpointTest extends BaseTest
{
    /**
     * @test
     */
    public function it_can_retrieve_a_list_of_shops() {
        $response = file_get_contents(__DIR__.'/../Responses/Shop/list.json');

        Http::fake([
            '*' => Http::response((array)json_decode($response))
        ]);

        $result = ShopFacade::initialize('http://localhost', 'test', 'test')->getAll();

        $this->assertInstanceOf(BaseResponseModel::class, $result);

        $this->assertInstanceOf(ShopListModel::class, $result->data->first());
    }

    /**
     * @test
     */
    public function it_can_retrieve_a_single_shop() {
        $response = file_get_contents(__DIR__.'/../Responses/Shop/single.json');

        Http::fake([
            '*' => Http::response((array)json_decode($response))
        ]);

        $result = ShopFacade::initialize('http://localhost', 'test', 'test')->getSingle(1);

        $this->assertInstanceOf(BaseResponseModel::class, $result);

        $this->assertInstanceOf(ShopSingleModel::class, $result->data);
    }
}