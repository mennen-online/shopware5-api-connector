<?php

namespace MennenOnline\Tests\Feature\Endpoints;

use Illuminate\Support\Facades\Http;
use MennenOnline\Shopware5ApiConnector\Facades\AddressFacade;
use MennenOnline\Shopware5ApiConnector\Facades\ArticleFacade;
use MennenOnline\Shopware5ApiConnector\Models\BaseResponseModel;
use MennenOnline\Shopware5ApiConnector\Models\Endpoints\Address\AddressListModel;
use MennenOnline\Shopware5ApiConnector\Models\Endpoints\Address\AddressSingleModel;
use MennenOnline\Shopware5ApiConnector\Models\Endpoints\Article\ArticleListModel;
use MennenOnline\Shopware5ApiConnector\Models\Endpoints\Article\ArticleSingleModel;
use MennenOnline\Shopware5ApiConnector\Tests\BaseTest;

class ArticleEndpointTest extends BaseTest
{
    /**
     * @test
     */
    public function it_can_retrieve_a_list_of_addresses() {
        $response = file_get_contents('./Responses/Article/list.json');

        Http::fake([
            '*' => Http::response((array)json_decode($response))
        ]);

        $result = ArticleFacade::initialize('http://localhost', 'test', 'test')->getAll();

        $this->assertInstanceOf(BaseResponseModel::class, $result);

        $this->assertInstanceOf(ArticleListModel::class, $result->data->first());
    }

    /**
     * @test
     */
    public function it_can_retrieve_a_single_address() {
        $response = file_get_contents('./Responses/Article/single.json');

        Http::fake([
            '*' => Http::response((array)json_decode($response))
        ]);

        $result = ArticleFacade::initialize('http://localhost', 'test', 'test')->getSingle(1);

        $this->assertInstanceOf(BaseResponseModel::class, $result);

        $this->assertInstanceOf(ArticleSingleModel::class, $result->data);
    }
}