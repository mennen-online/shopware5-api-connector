<?php

namespace MennenOnline\Shopware5ApiConnector\Tests\Feature\Endpoints;

use Illuminate\Support\Facades\Http;
use MennenOnline\Shopware5ApiConnector\Facades\ManufacturerFacade;
use MennenOnline\Shopware5ApiConnector\Facades\MediaFacade;
use MennenOnline\Shopware5ApiConnector\Models\BaseResponseModel;
use MennenOnline\Shopware5ApiConnector\Models\Endpoints\Manufacturer\ManufacturerListModel;
use MennenOnline\Shopware5ApiConnector\Models\Endpoints\Manufacturer\ManufacturerSingleModel;
use MennenOnline\Shopware5ApiConnector\Models\Endpoints\Media\MediaListModel;
use MennenOnline\Shopware5ApiConnector\Models\Endpoints\Media\MediaSingleModel;
use MennenOnline\Shopware5ApiConnector\Tests\BaseTest;

class MediaEndpointTest extends BaseTest
{
    /**
     * @test
     */
    public function it_can_retrieve_a_list_of_media() {
        $response = file_get_contents(__DIR__.'/../Responses/Media/list.json');

        Http::fake([
            '*' => Http::response((array)json_decode($response))
        ]);

        $result = MediaFacade::initialize('http://localhost', 'test', 'test')->getAll();

        $this->assertInstanceOf(BaseResponseModel::class, $result);

        $this->assertInstanceOf(MediaListModel::class, $result->data->first());
    }

    /**
     * @test
     */
    public function it_can_retrieve_a_single_media() {
        $response = file_get_contents(__DIR__.'/../Responses/Media/single.json');

        Http::fake([
            '*' => Http::response((array)json_decode($response))
        ]);

        $result = MediaFacade::initialize('http://localhost', 'test', 'test')->getSingle(1);

        $this->assertInstanceOf(BaseResponseModel::class, $result);

        $this->assertInstanceOf(MediaSingleModel::class, $result->data);
    }
}