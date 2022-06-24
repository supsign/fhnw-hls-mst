<?php

namespace App\Services\CourseGroupYear;

use App\Models\Completion;
use App\Models\CourseGroupYear;
use App\Models\Student;
use App\Services\Base\BaseModelService;
use App\Services\Base\Traits\UpdateOrCreateTrait;
use App\Services\Completion\CourseCompletionService;
use App\Services\CourseCourseGroupYear\CourseCourseGroupYearService;

class CourseGroupYearService extends BaseModelService
{
    use UpdateOrCreateTrait;

    public function __construct(
        protected CourseGroupYear $model, 
        protected CourseCompletionService $courseCompletionService, 
        protected CourseCourseGroupYearService $courseCourseGroupYearService
    ) {
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

        $otherCompletions = $student
            ->completions
            ->filter(fn (Completion $completion) => $completion->course_group_id === $courseGroupYear->course_group_id && in_array($completion->completion_type_id, [2, 4]));

        foreach ($otherCompletions AS $otherCompletion) {
            $credits += $otherCompletion->credits;
        }

        return $credits;
    }

    public function hasVisitedAtLeastOneCourse(CourseGroupYear $courseGroupYear, Student $student): bool
    {
        foreach ($courseGroupYear->courses as $course) {
            if ($this->courseCompletionService->courseIsSuccessfullyCompleted($course, $student)) {
                return true;
            }

            if ($this->courseCompletionService->courseHasFailedCompletions($course, $student)) {
                return true;
            }
        }

        return false;
    }

    public function setCreditToPass(CourseGroupYear $courseGroupYear, int $credits_to_pass = null)
    {
        $courseGroupYear->credits_to_pass = $credits_to_pass;
        $courseGroupYear->save();

        return $courseGroupYear;
    }
}
