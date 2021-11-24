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

    public function getPoints(Course $course, Student $student): int
    {
        $points = 0;

        foreach ($this->getSuccessfulCompletionsByStudent($course, $student) AS $completion) {
            $points += $completion->credits;
        }

        return $points;
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

    public function getSuccessfulCompletionsByStudent(Course $course, Student $student): Collection
    {
        $completions = $student->completions()->whereIn('completion_type_id', [2, 4])->get();

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
