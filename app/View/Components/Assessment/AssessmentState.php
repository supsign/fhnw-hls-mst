<?php

namespace App\View\Components\Assessment;

use App\Models\Assessment;
use App\Models\Planning;
use App\Services\Assessment\AssessmentService;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class AssessmentState extends Component
{
    public ?Assessment $assessment;
    public Collection $assessmentCourses;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(public Planning $planning, AssessmentService $assessmentService)
    {
        $this->assessment = $assessmentService->getApplicableAssessment($planning);
        $this->assessmentCourses = $this->assessment?->courses ?: collect();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|Closure|string
     */
    public function render()
    {
        return view('components.assessment.assessment-state');
    }
}
