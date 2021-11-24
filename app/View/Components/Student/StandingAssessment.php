<?php

namespace App\View\Components\Student;

use App\Models\Student;
use App\Services\Assessment\AssessmentService;
use Illuminate\View\Component;

class StandingAssessment extends Component
{

    public int $coursesPassed;
    public bool $completed;

    public function __construct(
        public Student $student,
        protected AssessmentService $assessmentService
    ) {
        $this->coursesPassed = $this->assessmentService->getPassedAmount($student->studyFieldYear->assessment, $this->student);
        $this->completed = $this->assessmentService->isSuccessfullyCompleted($student->studyFieldYear->assessment, $this->student);
    }

    public function render()
    {
        return view('components.student.standing-assessment');
    }
}
