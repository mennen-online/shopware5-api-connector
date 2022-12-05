<?php

namespace MennenOnline\Shopware5ApiConnector\Tests\Feature\Endpoints;

use Illuminate\Support\Facades\Http;
use MennenOnline\Shopware5ApiConnector\Facades\CountryFacade;
use MennenOnline\Shopware5ApiConnector\Facades\CustomerFacade;
use MennenOnline\Shopware5ApiConnector\Models\BaseResponseModel;
use MennenOnline\Shopware5ApiConnector\Models\Endpoints\Country\CountryListModel;
use MennenOnline\Shopware5ApiConnector\Models\Endpoints\Country\CountrySingleModel;
use MennenOnline\Shopware5ApiConnector\Models\Endpoints\Customer\CustomerListModel;
use MennenOnline\Shopware5ApiConnector\Models\Endpoints\Customer\CustomerSingleModel;
use MennenOnline\Shopware5ApiConnector\Tests\BaseTest;

class CustomerEndpointTest extends BaseTest
{
    /**
     * @test
     */
    public function it_can_retrieve_a_list_of_customers() {
        $response = file_get_contents('./Responses/Customer/list.json');

        Http::fake([
            '*' => Http::response((array)json_decode($response))
        ]);

        $result = CustomerFacade::initialize('http://localhost', 'test', 'test')->getAll();

        $this->assertInstanceOf(BaseResponseModel::class, $result);

        $this->assertInstanceOf(CustomerListModel::class, $result->data->first());
    }

    /**
     * @test
     */
    public function it_can_retrieve_a_single_customer() {
        $response = file_get_contents('./Responses/Customer/single.json');

        Http::fake([
            '*' => Http::response((array)json_decode($response))
        ]);

        $result = CustomerFacade::initialize('http://localhost', 'test', 'test')->getSingle(1);

        $this->assertInstanceOf(BaseResponseModel::class, $result);

        $this->assertInstanceOf(CustomerSingleModel::class, $result->data);
    }
}