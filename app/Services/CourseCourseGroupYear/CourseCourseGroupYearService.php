<?php

namespace App\Services\CourseCourseGroupYear;

use App\Models\CourseCourseGroupYear;
use App\Services\Base\BaseModelService;
use App\Services\Base\Traits\FirstOrCreateTrait;

class CourseCourseGroupYearService extends BaseModelService
{
    use FirstOrCreateTrait;

    public function __construct(protected CourseCourseGroupYear $model)
    {
        parent::__construct($model);
    }
}
