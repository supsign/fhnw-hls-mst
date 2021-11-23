<?php

namespace App\Services\CourseGroupYear;

use App\Models\CourseGroupYear;
use App\Models\Student;
use App\Services\Completion\CourseCompletionService;

class CourseGroupYearCompletionService
{
    public function __construct(protected CourseCompletionService $courseCompletionService)
    {
    }

    public function courseGroupIsCompleted(CourseGroupYear $courseGroupYear, Student $student): bool
    {
        $receivedPoints = 0;

        foreach ($courseGroupYear->courses as $cours) {
            if ($this->courseCompletionService->courseIsSuccessfullyCompleted($cours, $student)) {
                $receivedPoints += $cours->credits;
            }
        }
    }
}
