<?php

namespace MennenOnline\Shopware5ApiConnector\Models;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use MennenOnline\LaravelResponseModels\Models\BaseModel;
use MennenOnline\Shopware5ApiConnector\Enums\Model;
use stdClass;

/**
 * @property int|null $total
 * @property Collection|null $data
 * @property bool|null $success
 */
class BaseResponseModel extends BaseModel
{
    protected array $fieldMap = [
        'total',
        'data',
        'success',
        'errors',
    ];

    public function __construct(Model $model = Model::SINGLE, array|object|null $attributes = [], string|null $mapClassForData = null)
    {
        parent::__construct($attributes);

        if (! $attributes) {
            return $this;
        }

        $attributes = (array) $attributes;

        if ($model === Model::INDEX) {
            if ($mapClassForData && !$this->mapClassForDataExists($mapClassForData)) {
                return $this;
            }elseif ($mapClassForData !== null) {
                $this->data = collect($attributes['data'])->map(function($entry) use($mapClassForData) {
                    return new $mapClassForData(attributes: $entry);
                });
            } else {
                $this->data = collect($attributes['data'])->map(function ($element) {
                    if (! is_array($element)) {
                        return $element;
                    }

                    $object = new stdClass();

                    foreach ($element as $key => $value) {
                        $object->$key = $value;
                    }

                    return $object;
                });
            }
        }

        if ($model === Model::SINGLE) {
            if($mapClassForData && !$this->mapClassForDataExists($mapClassForData)) {
                return $this;
            } elseif($mapClassForData !== null) {
                $this->data = new $mapClassForData(attributes: $attributes['data'] ?? $attributes);
            } else {
                $object = new stdClass();
                collect($attributes['data'] ?? $attributes)->each(function ($value, $key) use ($object) {
                    $object->$key = $value;
                });
                $this->data = $object;
            }
        }
    }

    private function mapClassForDataExists(string $mapClassForData): bool {
        if(! class_exists($mapClassForData)) {
            Log::warning('Not existing Map Class used', [
                'fqcn' => $mapClassForData,
            ]);
            return false;
        }
        return true;
    }
}
