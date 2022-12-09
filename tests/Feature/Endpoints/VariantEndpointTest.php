<?php

namespace MennenOnline\Shopware5ApiConnector\Tests\Feature\Endpoints;

use Illuminate\Support\Facades\Http;
use MennenOnline\Shopware5ApiConnector\Facades\VariantFacade;
use MennenOnline\Shopware5ApiConnector\Models\BaseResponseModel;
use MennenOnline\Shopware5ApiConnector\Models\Endpoints\Variant\VariantListModel;
use MennenOnline\Shopware5ApiConnector\Models\Endpoints\Variant\VariantSingleModel;
use MennenOnline\Shopware5ApiConnector\Tests\BaseTest;

class VariantEndpointTest extends BaseTest
{
    /**
     * @test
     */
    public function it_can_retrieve_a_list_of_variants() {
        $response = file_get_contents(__DIR__.'/Responses/Variant/list.json');

        Http::fake([
            '*' => Http::response((array)json_decode($response))
        ]);

        $result = VariantFacade::initialize('http://localhost', 'test', 'test')->getAll();

        $this->assertInstanceOf(BaseResponseModel::class, $result);

        $this->assertInstanceOf(VariantListModel::class, $result->data->first());
    }

    /**
     * @test
     */
    public function it_can_retrieve_a_single_variant() {
        $response = file_get_contents(__DIR__.'/Responses/Variant/single.json');

        Http::fake([
            '*' => Http::response((array)json_decode($response))
        ]);

        $result = VariantFacade::initialize('http://localhost', 'test', 'test')->getSingle(1);

        $this->assertInstanceOf(BaseResponseModel::class, $result);

        $this->assertInstanceOf(VariantSingleModel::class, $result->data);
    }
}