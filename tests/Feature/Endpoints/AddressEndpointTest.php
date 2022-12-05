<?php

namespace MennenOnline\Shopware5ApiConnector\Tests\Feature\Endpoints;

use Illuminate\Support\Facades\Http;
use MennenOnline\Shopware5ApiConnector\Facades\AddressFacade;
use MennenOnline\Shopware5ApiConnector\Models\BaseResponseModel;
use MennenOnline\Shopware5ApiConnector\Tests\BaseTest;
use MennenOnline\Shopware5ApiConnector\Models\Endpoints\Address\AddressListModel;
use MennenOnline\Shopware5ApiConnector\Models\Endpoints\Address\AddressSingleModel;

class AddressEndpointTest extends BaseTest
{
    /**
     * @test
     */
    public function it_can_retrieve_a_list_of_addresses() {
        $response = file_get_contents('./Responses/Address/list.json');

        Http::fake([
            '*' => Http::response((array)json_decode($response))
        ]);

        $result = AddressFacade::initialize('http://localhost', 'test', 'test')->getAll();

        $this->assertInstanceOf(BaseResponseModel::class, $result);

        $this->assertInstanceOf(AddressListModel::class, $result->data->first());
    }

    /**
     * @test
     */
    public function it_can_retrieve_a_single_address() {
        $response = file_get_contents('./Responses/Address/single.json');
        
        Http::fake([
            '*' => Http::response((array)json_decode($response))
        ]);

        $result = AddressFacade::initialize('http://localhost', 'test', 'test')->getSingle(1);

        $this->assertInstanceOf(BaseResponseModel::class, $result);

        $this->assertInstanceOf(AddressSingleModel::class, $result->data);
    }
}