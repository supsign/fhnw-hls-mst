<?php

namespace App\Services\CourseGroupYear;

use App\Models\CourseGroupYear;
use App\Models\Student;
use App\Services\Base\BaseModelService;
use App\Services\Base\Traits\UpdateOrCreateTrait;
use App\Services\Completion\CourseCompletionService;

class CourseGroupYearService extends BaseModelService
{
    use UpdateOrCreateTrait;

    public function __construct(protected CourseGroupYear $model, protected CourseCompletionService $courseCompletionService)
    {
        parent::__construct($model);
    }

    public function courseGroupYearIsSuccessfullyCompleted(CourseGroupYear $courseGroupYear, Student $student): bool
    {
        foreach ($courseGroupYear->courses AS $course) {
            if ($this->courseCompletionService->courseIsSuccessfullyCompleted($course, $student)) {
                continue;
            }

            return false;
        }

        return true;
    }
}
