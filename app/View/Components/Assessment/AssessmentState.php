<?php

namespace App\View\Components\Assessment;

use App\Models\Assessment;
use App\Models\CrossQualification;
use App\Models\CrossQualificationYear;
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
    public Collection $assessmentCourses;
    public ?Specialization $specialization;
    public ?SpecializationYear $specializationYear;
    public ?Collection $specializationCourses;
    public ?CrossQualification $crossQualification;
    public ?CrossQualificationYear $crossQualificationYear;
    public ?Collection $crossQualificationCourses;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(public Planning $planning, AssessmentService $assessmentService)
    {
        $this->assessment = $assessmentService->getApplicableAssessment($planning);
        $this->assessmentCourses = $this->assessment?->courses ?: collect();
        $this->specialization = $this->planning->specializationYear?->specialization;
        $this->specializationYear = $this->planning->specializationYear;
        $this->specializationCourses = $this->planning->specializationYear?->courses;
        $this->crossQualification = $this->planning->crossQualificationYear?->crossQualification;
        $this->crossQualificationYear = $this->planning->crossQualificationYear;
        $this->crossQualificationCourses = $this->planning->crossQualificationYear?->courses;
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
