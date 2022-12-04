<?php

namespace MennenOnline\Shopware5ApiConnector\Interfaces\Endpoint;

use MennenOnline\Shopware5ApiConnector\Models\BaseResponseModel;

interface Shopware5EndpointInterface
{
    public function getAll(int|null $limit = null): BaseResponseModel;

    public function getSingle(int|string $id): BaseResponseModel;

    public function create(array $data = []): BaseResponseModel;

    public function update(string $id, array $data = []): BaseResponseModel;

    public function delete(string $id): BaseResponseModel;
}
