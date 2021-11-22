<?php

namespace App\Services\SpecializationYear;

use App\Models\SpecializationYear;
use App\Services\Base\BaseModelService;
use App\Services\Base\Traits\FirstOrCreateTrait;

class SpecializationYearService extends BaseModelService
{
    use FirstOrCreateTrait;

    public function __construct(protected SpecializationYear $model)
    {
        parent::__construct($model);
    }
}
