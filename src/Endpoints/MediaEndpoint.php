<?php

namespace MennenOnline\Shopware5ApiConnector\Endpoints;

use MennenOnline\Shopware5ApiConnector\Enums\EndpointEnum;
use MennenOnline\Shopware5ApiConnector\Models\BaseResponseModel;
use MennenOnline\Shopware5ApiConnector\Models\Endpoints\Media\MediumListModel;
use MennenOnline\Shopware5ApiConnector\Models\Endpoints\Media\MediumSingleModel;
use MennenOnline\Shopware5ApiConnector\Shopware5ApiConnector;

class MediaEndpoint extends Endpoint
{
    public function initialize(?string $url = null, ?string $username = null, ?string $password = null): Shopware5ApiConnector
    {
        $this->endpoint = EndpointEnum::MEDIA;

        return parent::initialize($url, $username, $password);
    }

    public function getAll(?int $limit = null): BaseResponseModel {
        return parent::getAll($limit);
    }

    public function getSingle(int|string $id): BaseResponseModel {
        return parent::getSingle($id);
    }
}
