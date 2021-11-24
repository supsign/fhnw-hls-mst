<?php

namespace App\Services\CrossQualificationYear;

use App\Models\CrossQualificationYear;
use App\Models\Student;
use App\Services\Base\BaseModelService;
use App\Services\Completion\CourseCompletionService;

class CrossQualificationYearService extends BaseModelService
{
    public function __construct(protected CrossQualificationYear $model, protected CourseCompletionService $courseCompletionService)
    {
        parent::__construct($model);
    }

    public function isSuccessfullyCompleted(CrossQualificationYear $crossQualifcationYear, Student $student): bool
    {
        return $this->getPassedAmount($crossQualifcationYear, $student) >= $crossQualifcationYear->amount_to_pass;
    }

    public function getPassedAmount(CrossQualificationYear $crossQualifcationYear, Student $student): int
    {
        $amount = 0;

        foreach ($crossQualifcationYear->courses as $course) {
            if ($this->courseCompletionService->courseIsSuccessfullyCompleted($course, $student)) {
                $amount++;
            }
        }

        return $amount;
    }
}
