<?php

namespace MennenOnline\Shopware5ApiConnector\Tests\Feature\Endpoints;

use Illuminate\Support\Facades\Http;
use MennenOnline\Shopware5ApiConnector\Facades\PropertyGroupFacade;
use MennenOnline\Shopware5ApiConnector\Models\BaseResponseModel;
use MennenOnline\Shopware5ApiConnector\Models\Endpoints\PropertyGroup\PropertyGroupListModel;
use MennenOnline\Shopware5ApiConnector\Models\Endpoints\PropertyGroup\PropertyGroupSingleModel;
use MennenOnline\Shopware5ApiConnector\Tests\BaseTest;

class PropertyGroupEndpointTest extends BaseTest
{
    /**
     * @test
     */
    public function it_can_retrieve_a_list_of_property_groups() {
        $response = file_get_contents(__DIR__.'/../Responses/PropertyGroup/list.json');

        Http::fake([
            '*' => Http::response((array)json_decode($response))
        ]);

        $result = PropertyGroupFacade::initialize('http://localhost', 'test', 'test')->getAll();

        $this->assertInstanceOf(BaseResponseModel::class, $result);

        $this->assertInstanceOf(PropertyGroupListModel::class, $result->data->first());
    }

    /**
     * @test
     */
    public function it_can_retrieve_a_single_property_group() {
        $response = file_get_contents(__DIR__.'/../Responses/PropertyGroup/single.json');

        Http::fake([
            '*' => Http::response((array)json_decode($response))
        ]);

        $result = PropertyGroupFacade::initialize('http://localhost', 'test', 'test')->getSingle(1);

        $this->assertInstanceOf(BaseResponseModel::class, $result);

        $this->assertInstanceOf(PropertyGroupSingleModel::class, $result->data);
    }
}