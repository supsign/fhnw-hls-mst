<?php

namespace App\Services\CourseGroupYear;

use App\Models\CourseGroupYear;
use App\Services\Base\BaseModelService;
use App\Services\Base\Traits\UpdateOrCreateTrait;

class CourseGroupYearService extends BaseModelService
{
    use UpdateOrCreateTrait;

    public function __construct(protected CourseGroupYear $model)
    {
        parent::__construct($model);
    }
}
