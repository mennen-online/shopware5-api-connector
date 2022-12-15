<?php

namespace Feature\Endpoints;

use Illuminate\Support\Facades\Http;
use MennenOnline\Shopware5ApiConnector\Facades\ManufacturerFacade;
use MennenOnline\Shopware5ApiConnector\Models\BaseResponseModel;
use MennenOnline\Shopware5ApiConnector\Models\Endpoints\Manufacturer\ManufacturerListModel;
use MennenOnline\Shopware5ApiConnector\Models\Endpoints\Manufacturer\ManufacturerSingleModel;
use MennenOnline\Shopware5ApiConnector\Tests\BaseTest;

class ManufacturerEndpointTest extends BaseTest
{
    /**
     * @test
     */
    public function it_can_retrieve_a_list_of_manufacturer() {
        $response = file_get_contents(__DIR__.'/../Responses/Manufacturer/list.json');

        Http::fake([
            '*' => Http::response((array)json_decode($response))
        ]);

        $result = ManufacturerFacade::initialize('http://localhost', 'test', 'test')->getAll();

        $this->assertInstanceOf(BaseResponseModel::class, $result);

        $this->assertInstanceOf(ManufacturerListModel::class, $result->data->first());
    }

    /**
     * @test
     */
    public function it_can_retrieve_a_single_manufacturer() {
        $response = file_get_contents(__DIR__.'/../Responses/Manufacturer/single.json');

        Http::fake([
            '*' => Http::response((array)json_decode($response))
        ]);

        $result = ManufacturerFacade::initialize('http://localhost', 'test', 'test')->getSingle(1);

        $this->assertInstanceOf(BaseResponseModel::class, $result);

        $this->assertInstanceOf(ManufacturerSingleModel::class, $result->data);
    }
}