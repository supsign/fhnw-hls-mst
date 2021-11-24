<?php

namespace App\View\Components\Student;

use App\Models\CrossQualificationYear;
use App\Models\Student;
use Illuminate\View\Component;

class StandingCrossqualification extends Component
{
    public function __construct(public CrossQualificationYear $crossQualificationYear, public Student $student)
    {
    }

    public function render()
    {
        return view('components.student.standing-crossqualification');
    }
}
