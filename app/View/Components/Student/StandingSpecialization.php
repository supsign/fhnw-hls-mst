<?php

namespace App\View\Components\Student;

use App\Models\SpecializationYear;
use App\Models\Student;
use App\Services\SpecializationYear\SpecializationYearService;
use Illuminate\View\Component;

class StandingSpecialization extends Component


{
    public int $coursedPassed;

    public function __construct(
        public SpecializationYear $specializationYear,
        public Student $student,
        protected SpecializationYearService $specializationYearService
    ) {
        $this->coursedPassed = $this->specializationYearService->getPassedAmount($this->specializationYear, $this->student);
    }

    public
    function render()
    {
        return view('components.student.standing-specialization');
    }
}
