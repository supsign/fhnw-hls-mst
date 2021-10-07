<?php

namespace App\Services\StudyProgram;

use App\Models\StudyProgram;
use App\Services\Base\BaseModelService;

class StudyProgramService extends BaseModelService
{
    public function __construct(protected StudyProgram $model)
    {
        parent::__construct($model);
    }
}
