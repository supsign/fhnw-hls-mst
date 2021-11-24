<?php

namespace App\Services\SpecializationYear;

use App\Models\SpecializationYear;
use App\Models\Student;
use App\Services\Base\BaseModelService;
use App\Services\Base\Traits\FirstOrCreateTrait;
use App\Services\Completion\CourseCompletionService;

class SpecializationYearService extends BaseModelService
{
    use FirstOrCreateTrait;

    public function __construct(protected SpecializationYear $model, protected CourseCompletionService $courseCompletionService)
    {
        parent::__construct($model);
    }

    public function getPassedAmount(SpecializationYear $specializationYear, Student $student): int
    {
        $amount = 0;

        foreach ($specializationYear->courses AS $course) {
            if ($this->courseCompletionService->courseIsSuccessfullyCompleted($course, $student)) {
                $amount++;
            }
        }

        return $amount;
    }
}
