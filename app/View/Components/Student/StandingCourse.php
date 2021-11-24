<?php

namespace App\View\Components\Student;

use App\Models\Course;
use App\Models\Student;
use App\Services\Completion\CourseCompletionService;
use Illuminate\View\Component;

class StandingCourse extends Component
{
    public function __construct(public Course $course, public Student $student, protected CourseCompletionService $courseCompletionService)
    {
    }

    public function render()
    {
        if (
            $this->courseCompletionService->courseIsSuccessfullyCompleted($this->course, $this->student) ||
            $this->courseCompletionService->courseHasFailedCompletions($this->course, $this->student)
        ) {
            return view('components.student.standing-course');
        }
    }
}
