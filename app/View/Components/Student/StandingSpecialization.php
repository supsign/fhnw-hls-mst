<?php

namespace App\View\Components\Student;

use App\Models\SpecializationYear;
use App\Models\Student;
use Illuminate\View\Component;

class StandingSpecialization extends Component
{
    public function __construct(public SpecializationYear $specializationYear, public Student $student)
    {
    }

    public function render()
    {
        return view('components.student.standing-specialization');
    }
}
