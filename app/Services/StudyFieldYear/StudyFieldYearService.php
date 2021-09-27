<?php

namespace App\Services\StudyFieldYear;

use App\Models\StudyFieldYear;
use App\Services\Base\BaseModelService;
use App\Services\Base\Traits\UpdateOrCreateTrait;
use App\Services\Base\Traits\UpdateTrait;

class StudyFieldYearService extends BaseModelService
{
    use UpdateTrait;
    use UpdateOrCreateTrait;

    public function __construct(protected StudyFieldYear $model)
    {
        parent::__construct($model);
    }
}
