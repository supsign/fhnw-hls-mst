<?php

namespace App\Services\CourseSpecializationYear;

use App\Models\CourseSpecializationYear;
use App\Services\Base\BaseModelService;
use App\Services\Base\Traits\UpdateOrCreateTrait;

class CourseSpecializationYearSerivce extends BaseModelService
{
    use UpdateOrCreateTrait;

    public function __construct(protected CourseSpecializationYear $model)
    {
        parent::__construct($model);
    }
}
