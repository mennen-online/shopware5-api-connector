<?php

namespace MennenOnline\Shopware5ApiConnector\Endpoints;

use MennenOnline\Shopware5ApiConnector\Enums\EndpointEnum;
use MennenOnline\Shopware5ApiConnector\Interfaces\Endpoint\Shopware5EndpointInterface;
use MennenOnline\Shopware5ApiConnector\Models\BaseResponseModel;
use MennenOnline\Shopware5ApiConnector\Shopware5ApiConnector;

class Endpoint extends Shopware5ApiConnector
{

    public function getAll(?int $limit = null): BaseResponseModel {
        return $this->index($this->endpoint, $limit);
    }

    public function getSingle(int|string $id): BaseResponseModel {
        return $this->get($this->endpoint, $id);
    }

    public function create(array $data = []): BaseResponseModel {
        // TODO: Implement create() method.
    }

    public function update(string $id, array $data = []): BaseResponseModel {
        // TODO: Implement update() method.
    }

    public function delete(string $id): BaseResponseModel {
        // TODO: Implement delete() method.
    }
}