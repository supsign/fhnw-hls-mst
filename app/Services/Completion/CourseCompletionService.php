<?php

namespace App\Services\Completion;

use App\Models\Course;
use App\Models\Student;
use Illuminate\Support\Collection;

class CourseCompletionService
{
    public function __construct(protected CompletionService $completionService)
    {

    }

    public function courseIsSuccessfullyCompleted(Course $course, Student $student): bool
    {
        $completions = $this->getCompletionsByStudent($course, $student);

        return $this->completionService->hasSuccessfulCompletions($completions);
    }

    public function getCompletionsByStudent(Course $course, Student $student): Collection
    {
        $completions = $student->completions;
        return $completions->filter(function ($completion) use ($course) {
            return $course->courseYears->contains($completion->courseYear);
        });
    }

    public function courseHasFailedCompletions(Course $course, Student $student): bool
    {
        $completions = $this->getCompletionsByStudent($course, $student);
        return $this->completionService->hasFailedCompletions($completions);
    }


}
