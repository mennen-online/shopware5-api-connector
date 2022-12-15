<?php

namespace Feature\Endpoints;

use Illuminate\Support\Facades\Http;
use MennenOnline\Shopware5ApiConnector\Facades\CountryFacade;
use MennenOnline\Shopware5ApiConnector\Models\BaseResponseModel;
use MennenOnline\Shopware5ApiConnector\Models\Endpoints\Country\CountryListModel;
use MennenOnline\Shopware5ApiConnector\Models\Endpoints\Country\CountrySingleModel;
use MennenOnline\Shopware5ApiConnector\Tests\BaseTest;

class CountryEndpointTest extends BaseTest
{
    /**
     * @test
     */
    public function it_can_retrieve_a_list_of_countries() {
        $response = file_get_contents(__DIR__.'/../Responses/Country/list.json');

        Http::fake([
            '*' => Http::response((array)json_decode($response))
        ]);

        $result = CountryFacade::initialize('http://localhost', 'test', 'test')->getAll();

        $this->assertInstanceOf(BaseResponseModel::class, $result);

        $this->assertInstanceOf(CountryListModel::class, $result->data->first());
    }

    /**
     * @test
     */
    public function it_can_retrieve_a_single_country() {
        $response = file_get_contents(__DIR__.'/../Responses/Country/single.json');

        Http::fake([
            '*' => Http::response((array)json_decode($response))
        ]);

        $result = CountryFacade::initialize('http://localhost', 'test', 'test')->getSingle(1);

        $this->assertInstanceOf(BaseResponseModel::class, $result);

        $this->assertInstanceOf(CountrySingleModel::class, $result->data);
    }
}