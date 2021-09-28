<?php

namespace App\Services\Semester;

use App\Models\Semester;
use App\Services\Base\BaseModelService;

class SemesterService extends BaseModelService
{
    public function __construct(protected Semester $model)
    {
        parent::__construct($model);
    }
}
