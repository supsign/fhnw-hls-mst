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

    public function isSuccessfullyCompleted(CourseGroupYear $courseGroupYear, Student $student): bool
    {
        return $this->getCredits($courseGroupYear, $student) >= $courseGroupYear->credits_to_pass;
    }

    public function getCredits(CourseGroupYear $courseGroupYear, Student $student): int
    {
        $credits = 0;

        foreach ($courseGroupYear->courses as $course) {
            $credits += $this->courseCompletionService->getCredits($course, $student);
        }

        return $credits;
    }

    public function hasVisitedAtLeastOneCourse(CourseGroupYear $courseGroupYear, Student $student): bool
    {
        foreach ($courseGroupYear->courses as $course) {
            if ($this->courseCompletionService->courseIsSuccessfullyCompleted($course, $student)) {
                return true;
            }
        }

        return false;
    }
}
