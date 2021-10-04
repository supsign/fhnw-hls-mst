<?php

namespace App\Services\Planning;

use App\Models\Planning;
use App\Services\Base\BaseModelService;

class PlanningService extends BaseModelService
{
    public function __construct(protected Planning $model)
    {
        parent::__construct($model);
    }

    public function update(Planning $planning, array $attributes): self
    {
        $planning->update($this->sanitiseAttributes($attributes));

        return $this;
    }
}
