<?php

namespace MennenOnline\Shopware5ApiConnector\Tests\Feature\Endpoints;

use Illuminate\Support\Facades\Http;
use MennenOnline\Shopware5ApiConnector\Facades\OrderFacade;
use MennenOnline\Shopware5ApiConnector\Facades\PaymentMethodFacade;
use MennenOnline\Shopware5ApiConnector\Models\BaseResponseModel;
use MennenOnline\Shopware5ApiConnector\Models\Endpoints\Order\OrderListModel;
use MennenOnline\Shopware5ApiConnector\Models\Endpoints\Order\OrderSingleModel;
use MennenOnline\Shopware5ApiConnector\Models\Endpoints\PaymentMethod\PaymentMethodListModel;
use MennenOnline\Shopware5ApiConnector\Models\Endpoints\PaymentMethod\PaymentMethodSingleModel;
use MennenOnline\Shopware5ApiConnector\Tests\BaseTest;

class PaymentMethodEndpointTest extends BaseTest
{
    /**
     * @test
     */
    public function it_can_retrieve_a_list_of_payment_methods() {
        $response = file_get_contents(__DIR__.'/Responses/PaymentMethod/list.json');

        Http::fake([
            '*' => Http::response((array)json_decode($response))
        ]);

        $result = PaymentMethodFacade::initialize('http://localhost', 'test', 'test')->getAll();

        $this->assertInstanceOf(BaseResponseModel::class, $result);

        $this->assertInstanceOf(PaymentMethodListModel::class, $result->data->first());
    }

    /**
     * @test
     */
    public function it_can_retrieve_a_single_payment_method() {
        $response = file_get_contents(__DIR__.'/Responses/PaymentMethod/single.json');

        Http::fake([
            '*' => Http::response((array)json_decode($response))
        ]);

        $result = PaymentMethodFacade::initialize('http://localhost', 'test', 'test')->getSingle(1);

        $this->assertInstanceOf(BaseResponseModel::class, $result);

        $this->assertInstanceOf(PaymentMethodSingleModel::class, $result->data);
    }
}