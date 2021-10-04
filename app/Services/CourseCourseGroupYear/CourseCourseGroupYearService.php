<?php

namespace App\Services\CourseCourseGroupYear;

use App\Models\CourseCourseGroupYear;
use App\Services\Base\BaseModelService;

class CourseCourseGroupYearService extends BaseModelService
{
    public function __construct(protected CourseCourseGroupYear $model)
    {
        parent::__construct($model);
    }
}