<?php

namespace MennenOnline\Shopware5ApiConnector\Endpoints;

use MennenOnline\Shopware5ApiConnector\Exceptions\NoEndpointDefinedException;
use MennenOnline\Shopware5ApiConnector\Models\BaseResponseModel;
use MennenOnline\Shopware5ApiConnector\Shopware5ApiConnector;
use TypeError;

class Endpoint extends Shopware5ApiConnector
{
    public function getAll(?int $limit = null): BaseResponseModel
    {
        if($this->endpoint === null) {
            throw new NoEndpointDefinedException('No Endpoint is defined yet. Did you forget to call initialize Method?');
        }
        return $this->index($this->endpoint, $limit);
    }

    public function getSingle(int|string $id): BaseResponseModel
    {
        if($this->endpoint === null) {
            throw new NoEndpointDefinedException('No Endpoint is defined yet. Did you forget to call initialize Method?');
        }
        return $this->get($this->endpoint, $id);
    }

    public function create(array $data = []): BaseResponseModel
    {
        // TODO: Implement create() method.
    }

    public function update(string $id, array $data = []): BaseResponseModel
    {
        // TODO: Implement update() method.
    }

    public function delete(string $id): BaseResponseModel
    {
        // TODO: Implement delete() method.
    }
}
