<?php

namespace App\Services\Base\Traits;

use App\Models\BaseModel;

trait UpdateTrait
{
    public function update(BaseModel $model, array $attributes): self
    {
        foreach ($this->sanitiseAttributes($attributes) AS $key => $value) {
            $model->$key = $value;
        }

        $model->save();

        return $this;
    }
}
