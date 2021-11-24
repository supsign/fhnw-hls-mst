<?php

namespace App\View\Components\Student;

use App\Models\CourseGroupYear;
use App\Models\Student;
use App\Services\CourseGroupYear\CourseGroupYearService;
use Illuminate\View\Component;

class StandingCourseGroup extends Component
{
    public int $reachedCredits;

    public function __construct(
        public CourseGroupYear $courseGroupYear,
        public Student $student,
        protected CourseGroupYearService $courseGroupYearService
    ) {
        $this->reachedCredits = $this->courseGroupYearService->getCredits($this->courseGroupYear, $this->student);


    }

    public function render()
    {
        if (!$this->courseGroupYearService->hasVisitedAtLeastOneCourse($this->courseGroupYear, $this->student)) {
            return;
        }

        return view('components.student.standing-course-group');
    }
}
