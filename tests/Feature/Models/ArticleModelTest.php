<?php

namespace MennenOnline\Shopware5ApiConnector\Tests\Feature\Models;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use MennenOnline\Shopware5ApiConnector\Facades\ArticleFacade;
use MennenOnline\Shopware5ApiConnector\Models\Endpoints\Article\ArticleListModel;
use MennenOnline\Shopware5ApiConnector\Tests\BaseTest;

class ArticleModelTest extends BaseTest
{
    private array $articleSingleKeys = [
        "id"                  => 718,
        "main_detail_id"      => null,
        "supplier_id"         => 3,
        "tax_id"              => 1,
        "price_group_id"      => null,
        "filter_group_id"     => null,
        "configurator_set_id" => null,
        "name"                => "Hakenleiste für Wandmontage",
        "description"         => "",
        "description_long"    => "<P>Hakenleiste aus Hartholz, ink. Haken, zur Wandmontage. Andere&nbsp;Längen und&nbsp;Farben auf Anfrage. Länge 2m</P>",
        "added"               => "2018-08-15T00:00:00+0200",
        "active"              => false,
        "pseudo_sales"        => 0,
        "highlight"           => false,
        "keywords"            => "umziehkabinen",
        "meta_title"          => "",
        "changed"             => "2019-04-04T10:46:12+0200",
        "price_group_active"  => false,
        "last_stock"          => false,
        "cross_bundle_look"   => 0,
        "notification"        => false,
        "template"            => "",
        "mode"                => 0,
        "available_from"      => null,
        "available_to"        => null,
        "main_detail"         => null,
        "tax"                 => [
            "id"   => 1,
            "tax"  => "7.70",
            "name" => "A1",
        ],
        "property_values"     => [],
        "supplier"            => [
            "meta_title"       => "",
            "meta_description" => "",
            "meta_keywords"    => "",
            "id"               => 3,
            "name"             => "Huspo",
            "image"            => "media/image/Huspo.png",
            "link"             => "http://www.huspo.ch",
            "description"      => "",
            "changed"          => "2018-10-11T06:57:22+0200",
        ],
        "property_group"      => null,
        "customer_groups"     => [],
        "images"              => [
            0 => [
                "id"                => 234050,
                "article_id"        => 718,
                "article_detail_id" => null,
                "description"       => "bz0187",
                "path"              => "bz0187",
                "main"              => 1,
                "position"          => 0,
                "width"             => 0,
                "height"            => 0,
                "relations"         => "",
                "extension"         => "jpg",
                "parent_id"         => null,
                "media_id"          => 1172,
            ],
            1 => [
                "id"                => 234051,
                "article_id"        => 718,
                "article_detail_id" => null,
                "description"       => "bz0187-1",
                "path"              => "bz0187-1",
                "main"              => 2,
                "position"          => 0,
                "width"             => 0,
                "height"            => 0,
                "relations"         => "",
                "extension"         => "jpg",
                "parent_id"         => null,
                "media_id"          => 1173,
            ],
            2 => [
                "id"                => 234052,
                "article_id"        => 718,
                "article_detail_id" => null,
                "description"       => "bz0187-2",
                "path"              => "bz0187-2",
                "main"              => 2,
                "position"          => 0,
                "width"             => 0,
                "height"            => 0,
                "relations"         => "",
                "extension"         => "jpg",
                "parent_id"         => null,
                "media_id"          => 1174,
            ]
        ],
        "configurator_set"    => null,
        "links"               => [],
        "downloads"           => [],
        "categories"          => [
            0 => [
                "id"   => 244,
                "name" => "Garderobe",
            ],
        ],
        "similar"             => null,
        "related"             => null,
        "details"             => [],
        "seo_categories"      => [],
        "translations"        => [
            8 => [
                "name"             => "Penderie à crochets",
                "description_long" => "Penderie à crochets escamotés en lattes en bois dur raboté, toutes avec bords arrondis.&nbsp;D'autres longueurs et coloris sur demande. Longeur: 200 cm.",
                "shop_id"          => 8,
            ],
        ]
    ];

    private array $articleListKeys = [
        'id',
        'main_detail_id',
        'supplier_id',
        'tax_id',
        'price_group_id',
        'filter_group_id',
        'configurator_set_id',
        'name',
        'description',
        'description_long',
        'added',
        'active',
        'pseudo_sales',
        'highlight',
        'keywords',
        'meta_title',
        'changed',
        'price_group_active',
        'last_stock',
        'cross_bundle_look',
        'notification',
        'template',
        'mode',
        'available_from',
        'available_to',
        'main_detail'
    ];

    /**
     * @test
     */
    public function it_has_all_expected_attributes_in_a_single_article_model() {
        $response = file_get_contents(__DIR__.'/../Responses/Article/single.json');

        Http::fake([
            '*' => Http::response((array) json_decode($response))
        ]);

        $result = ArticleFacade::initialize('http://localhost', 'test', 'test')->getSingle(1);

        $model = $result->data;

        $attributes = $model->getAttributes();

        foreach(array_keys($this->articleSingleKeys) as $key) {
            $this->assertArrayHasKey($key, $attributes);
        }
    }

    /**
     * @test
     */
    public function it_has_all_expected_attributes_in_a_list_article_model() {
        $response = file_get_contents(__DIR__.'/../Responses/Article/list.json');

        Http::fake([
            '*' => Http::response((array)json_decode($response))
        ]);

        $result = ArticleFacade::initialize('http://localhost', 'test', 'test')->getAll();

        $this->assertInstanceOf(Collection::class, $result->data);

        $this->assertInstanceOf(ArticleListModel::class, $result->data->first());

        $model = $result->data->first();

        $attributes = $model->getAttributes();

        foreach($this->articleListKeys as $key) {
            $this->assertArrayHasKey($key, $attributes);
        }
    }
}