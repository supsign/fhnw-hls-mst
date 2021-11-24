<?php

namespace App\View\Components\Student;

use App\Models\CrossQualificationYear;
use App\Models\Student;
use App\Services\CrossQualificationYear\CrossQualificationYearService;
use Illuminate\View\Component;

class StandingCrossqualification extends Component
{

    public int $coursedPassed;


    public function __construct(
        public CrossQualificationYear $crossQualificationYear,
        public Student $student,
        protected CrossQualificationYearService $crossQualificationYearService
    ) {
        $this->coursedPassed = $this->crossQualificationYearService->getPassedAmount($this->crossQualificationYear, $this->student);

    }

    public function render()
    {
        return view('components.student.standing-crossqualification');
    }
}
