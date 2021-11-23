<?php

namespace App\View\Components\Assessment;

use App\Models\Assessment;
use App\Models\Planning;
use App\Models\Semester;
use App\Models\Specialization;
use App\Models\SpecializationYear;
use App\Services\Assessment\AssessmentService;
use App\Services\Semester\SemesterService;
use App\Services\Specialization\SpecializationService;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class AssessmentState extends Component
{
    public ?Assessment $assessment;
    public ?Assessment $specialization;
    public Collection $assessmentCourses;
    public Collection $specialisationCourses;
    public ?SpecializationYear $specialisationYear;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(public Planning $planning, AssessmentService $assessmentService)
    {
        $this->assessment = $assessmentService->getApplicableAssessment($planning);
        $this->specialization = $assessmentService->getApplicableAssessment($planning);
        $this->assessmentCourses = $this->assessment?->courses ?: collect();
        $this->specialisationCourses = $this->specialization->courses ?: collect();
        $this->specialisationYear = $this->specialization->specializationYear;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|Closure|string
     */
    public function render()
    {
        return view('components.assessment.assessment-state', [
            'semesters' => Semester::all(),
        ]);
    }
}
