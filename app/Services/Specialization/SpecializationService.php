<?php

namespace App\Services\Specialization;

use App\Models\Specialization;
use App\Services\Base\BaseModelService;
use App\Services\Base\Traits\FirstOrCreateTrait;

class SpecializationService extends BaseModelService
{
    use FirstOrCreateTrait;

    public function __construct(protected Specialization $model)
    {
        parent::__construct($model);
    }
}