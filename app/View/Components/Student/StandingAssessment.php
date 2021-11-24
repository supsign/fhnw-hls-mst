<?php

namespace App\View\Components\Student;

use App\Models\Student;
use Illuminate\View\Component;

class StandingAssessment extends Component
{

    public function __construct(public Student $student)
    {


    }

    public function render()
    {
        return view('components.student.standing-assessment');
    }
}