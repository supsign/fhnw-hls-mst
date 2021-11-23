<?php

namespace App\View\Components\Student;

use App\Models\CourseGroupYear;
use App\Models\Student;
use Illuminate\View\Component;

class StandingCourseGroup extends Component
{
    public function __construct(public CourseGroupYear $courseGroupYear, public Student $student)
    {


    }

    public function render()
    {
        return view('components.student.standing-course-group');
    }
}