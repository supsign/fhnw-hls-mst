<?php

namespace App\Services\Base;

use App\Helpers\Support\GeneralHelper;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Collection;

class BaseModelService
{
    public function __construct(private BaseModel $model)
    {
    }

    public function getById(int $id): ?BaseModel
    {
        return $this->model::find($id);
    }

    public function getByIds(array $ids): Collection
    {
        return $this->model::find($ids);
    }

    protected function sanitiseAttributes(array $attributes): array
    {
        return array_intersect_key(
            $attributes,
            array_flip(GeneralHelper::getModelColumns($this->model)),
        );
    }
}
