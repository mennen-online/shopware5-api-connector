<?php

namespace MennenOnline\Shopware5ApiConnector\Endpoints;

use MennenOnline\Shopware5ApiConnector\Enums\EndpointEnum;
use MennenOnline\Shopware5ApiConnector\Models\BaseResponseModel;
use MennenOnline\Shopware5ApiConnector\Models\Endpoints\GenerateArticleImage\GenerateArticleImageListModel;
use MennenOnline\Shopware5ApiConnector\Models\Endpoints\GenerateArticleImage\GenerateArticleImageSingleModel;
use MennenOnline\Shopware5ApiConnector\Shopware5ApiConnector;

class GenerateArticleImageEndpoint extends Endpoint
{
    public function initialize(?string $url = null, ?string $username = null, ?string $password = null): Shopware5ApiConnector
    {
        $this->endpoint = EndpointEnum::GENERATE_ARTICLE_IMAGES;

        return parent::initialize($url, $username, $password);
    }
}
