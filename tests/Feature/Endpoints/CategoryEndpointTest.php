<?php

namespace MennenOnline\Shopware5ApiConnector\Tests\Feature\Endpoints;

use Illuminate\Support\Facades\Http;
use MennenOnline\Shopware5ApiConnector\Facades\CategoryFacade;
use MennenOnline\Shopware5ApiConnector\Models\BaseResponseModel;
use MennenOnline\Shopware5ApiConnector\Models\Endpoints\Category\CategoryListModel;
use MennenOnline\Shopware5ApiConnector\Models\Endpoints\Category\CategorySingleModel;
use MennenOnline\Shopware5ApiConnector\Tests\BaseTest;

class CategoryEndpointTest extends BaseTest
{
    /**
     * @test
     */
    public function it_can_retrieve_a_list_of_categories() {
        $response = file_get_contents('./Responses/Category/list.json');

        Http::fake([
            '*' => Http::response((array)json_decode($response))
        ]);

        $result = CategoryFacade::initialize('http://localhost', 'test', 'test')->getAll();

        $this->assertInstanceOf(BaseResponseModel::class, $result);

        $this->assertInstanceOf(CategoryListModel::class, $result->data->first());
    }

    /**
     * @test
     */
    public function it_can_retrieve_a_single_category() {
        $response = file_get_contents('./Responses/Category/single.json');

        Http::fake([
            '*' => Http::response((array)json_decode($response))
        ]);

        $result = CategoryFacade::initialize('http://localhost', 'test', 'test')->getSingle(1);

        $this->assertInstanceOf(BaseResponseModel::class, $result);

        $this->assertInstanceOf(CategorySingleModel::class, $result->data);
    }
}