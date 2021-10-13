<?php

namespace App\View\Components\Planning;

use App\Models\Course;
use App\Models\Student;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class Completion extends Component
{
    public int $icon = 0;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(public Course $course, public Student $student)
    {
        $completions = $this->student->completions;
        $completionsOfCourse = $completions->filter(function ($completion) use ($course) {
            return $course->courseYears->contains($completion->courseYear);
        });

        $this->evaluateSymbol($completionsOfCourse);
    }

    public function evaluateSymbol(Collection $completions)
    {
        if ($this->hasNoCompletedCompletions($completions)) {
            $this->icon = 1;

            return;
        }

        if ($this->hasOneSuccessfulCompletion($completions)) {
            $this->icon = 2;

            return;
        }

        $this->icon = 3;
    }

    public function hasNoCompletedCompletions(Collection $completions)
    {
        if ($completions->count() === 0) {
            return true;
        }

        foreach ($completions as $completion) {
            if ($completion->completion_type_id !== 1) {
                return false;
            }
        }

        return true;
    }

    public function hasOneSuccessfulCompletion(Collection $completions)
    {
        $successfulCompletions = $completions->filter(function ($completion) {
            return $completion->completion_type_id === 2 || $completion->completion_type_id === 4;
        });

        if ($successfulCompletions->count() !== 0) {
            return true;
        }

        return false;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.planning.completion');
    }
}
