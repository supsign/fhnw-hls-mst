<?php

namespace App\View\Components\Student;

use App\Models\Course;
use App\Models\Student;
use App\Services\Completion\CourseCompletionService;
use Illuminate\View\Component;

class StandingCourseAssessment extends Component
{
    public function __construct(public Course $course, public Student $student, protected CourseCompletionService $courseCompletionService)
    {
    }

    public function render()
    {
        return view('components.student.standing-course-assessment');
    }
}
