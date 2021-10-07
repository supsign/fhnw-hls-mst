<?php

namespace App\Services\CourseGroup;

use App\Models\CourseGroup;
use App\Services\Base\BaseModelService;
use App\Services\Base\Traits\GetByImportIdTrait;
use App\Services\Base\Traits\UpdateOrCreateByImportIdTrait;

class CourseGroupService extends BaseModelService
{
    use GetByImportIdTrait;
    use UpdateOrCreateByImportIdTrait;

    public function __construct(protected CourseGroup $model)
    {
        parent::__construct($model);
    }
}
