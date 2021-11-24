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

    public function isSuccessfullyCompleted(SpecializationYear $specializationYear, Student $student): bool
    {
        return $this->getPassedAmount($specializationYear, $student) >= $specializationYear->amount_to_pass;
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
