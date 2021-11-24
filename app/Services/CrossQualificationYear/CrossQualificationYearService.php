<?php

namespace App\Services\CrossQualificationYear;

use App\Models\CrossQualificationYear;
use App\Models\Student;
use App\Services\Base\BaseModelService;

class CrossQualificationYearService extends BaseModelService
{
    public function __construct(protected CrossQualificationYear $model)
    {
        parent::__construct($model);
    }

    public function getPassedAmount(CrossQualificationYear $crossQualifcationYear, Student $student): int
    {
        $amount = 0;

        foreach ($crossQualifcationYear->courses AS $course) {
            if ($this->courseCompletionService->courseIsSuccessfullyCompleted($course, $student)) {
                $amount++;
            }
        }

        return $amount;
    }
}
