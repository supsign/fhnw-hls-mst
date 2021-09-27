<?php

namespace App\Services\StudyField;

use App\Models\StudyField;
use App\Services\Base\BaseModelService;
use App\Services\Base\Traits\UpdateTrait;

class StudyFieldService extends BaseModelService
{
    use UpdateTrait;

    public function __construct(protected StudyField $model)
    {
        parent::__construct($model);
    }
}
