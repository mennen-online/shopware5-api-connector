<?php

namespace MennenOnline\Shopware5ApiConnector\Tests\Feature\Models;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use MennenOnline\Shopware5ApiConnector\Facades\AddressFacade;
use MennenOnline\Shopware5ApiConnector\Models\Endpoints\Address\AddressListModel;
use MennenOnline\Shopware5ApiConnector\Models\Endpoints\Country\CountrySingleModel;
use MennenOnline\Shopware5ApiConnector\Models\Endpoints\Customer\CustomerSingleModel;
use MennenOnline\Shopware5ApiConnector\Tests\BaseTest;

class AddressModelTest extends BaseTest
{
    /**
     * @test
     */
    public function it_has_all_expected_attributes_in_a_single_address_model() {
        $response = file_get_contents(__DIR__.'/../Responses/Address/single.json');

        Http::fake([
            '*' => Http::response((array)json_decode($response))
        ]);

        $result = AddressFacade::initialize('http://localhost', 'test', 'test')->getSingle(1);

        $model = $result->data;
        
        $attributes = $model->getAttributes();

        $this->testAttributes($attributes);

        $this->assertInstanceOf(CustomerSingleModel::class, $model->getCustomerAttribute());

        $this->assertInstanceOf(CountrySingleModel::class, $model->getCountryAttribute());
    }

    /**
     * @test
     */
    public function it_has_all_expected_attributes_in_list_address_model() {
        $response = file_get_contents(__DIR__.'/../Responses/Address/list.json');

        Http::fake([
            '*' => Http::response((array)json_decode($response))
        ]);

        $result = AddressFacade::initialize('http://localhost', 'test', 'test')->getAll();

        $this->assertInstanceOf(Collection::class, $result->data);

        $this->assertInstanceOf(AddressListModel::class, $result->data->first());

        $model = $result->data->first();

        $this->testAttributes($model->getAttributes());
    }

    private function testAttributes(array $attributes) {
        $this->assertArrayHasKey('id', $attributes);

        $this->assertArrayHasKey('company', $attributes);

        $this->assertArrayHasKey('department', $attributes);

        $this->assertArrayHasKey('salutation', $attributes);

        $this->assertArrayHasKey('firstname', $attributes);

        $this->assertArrayHasKey('lastname', $attributes);

        $this->assertArrayHasKey('street', $attributes);

        $this->assertArrayHasKey('zipcode', $attributes);

        $this->assertArrayHasKey('city', $attributes);

        $this->assertArrayHasKey('phone', $attributes);

        $this->assertArrayHasKey('vat_id', $attributes);

        $this->assertArrayHasKey('additional_address_line1', $attributes);

        $this->assertArrayHasKey('additional_address_line2', $attributes);

        $this->assertArrayHasKey('country', $attributes);

        $this->assertArrayHasKey('customer', $attributes);

        $this->assertArrayHasKey('state', $attributes);

        $this->assertArrayHasKey('attribute', $attributes);
    }
}