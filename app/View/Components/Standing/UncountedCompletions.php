<?php

namespace App\View\Components\Standing;

use App\Models\Student;
use App\Models\StudyFieldYear;
use App\Services\Completion\UncountedCompletionService;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class UncountedCompletions extends Component
{
    public Collection $completions;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(public Student $student, public StudyFieldYear $studyFieldYear, UncountedCompletionService $uncountedCompletionService)
    {
        $this->completions = $uncountedCompletionService->getSuccessfullCompletionsOfOtherStudyFields($student, $studyFieldYear);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|Closure|string
     */
    public function render()
    {
        if (!$this->completions->count()) {
            return;
        }
        return view('components.standing.uncounted-completions', ['completions' => $this->completions]);
    }
}
