<?php

namespace Feature\Endpoints;

use Illuminate\Support\Facades\Http;
use MennenOnline\Shopware5ApiConnector\Facades\CacheFacade;
use MennenOnline\Shopware5ApiConnector\Models\BaseResponseModel;
use MennenOnline\Shopware5ApiConnector\Models\Endpoints\Cache\CacheListModel;
use MennenOnline\Shopware5ApiConnector\Models\Endpoints\Cache\CacheSingleModel;
use MennenOnline\Shopware5ApiConnector\Tests\BaseTest;

class CacheEndpointTest extends BaseTest
{
    /**
     * @test
     */
    public function it_can_retrieve_a_list_of_caches() {
        $response = file_get_contents(__DIR__.'/Responses/Cache/list.json');

        Http::fake([
            '*' => Http::response((array)json_decode($response))
        ]);

        $result = CacheFacade::initialize('http://localhost', 'test', 'test')->getAll();

        $this->assertInstanceOf(BaseResponseModel::class, $result);

        $this->assertInstanceOf(CacheListModel::class, $result->data->first());
    }

    /**
     * @test
     */
    public function it_can_retrieve_a_single_cache() {
        $response = file_get_contents(__DIR__.'/Responses/Cache/single.json');

        Http::fake([
            '*' => Http::response((array)json_decode($response))
        ]);

        $result = CacheFacade::initialize('http://localhost', 'test', 'test')->getSingle(1);

        $this->assertInstanceOf(BaseResponseModel::class, $result);

        $this->assertInstanceOf(CacheSingleModel::class, $result->data);
    }
}