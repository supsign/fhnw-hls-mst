<?php

namespace App\View\Components\Planning;

use App\Models\Course;
use App\Models\Student;
use App\Services\Completion\CourseCompletionService;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Completion extends Component
{
    public int $icon = 3;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(public Course $course, public Student $student, protected CourseCompletionService $courseCompletionService)
    {
        $completionsOfCourse = $this->courseCompletionService->getCompletionsByStudent($course, $this->student);

        $this->evaluateSymbol($course, $this->student);
    }

    public function evaluateSymbol(Course $course, Student $student)
    {


        if ($this->courseCompletionService->courseIsSuccessfullyCompleted($course, $student)) {
            $this->icon = 1;

            return;
        }

        if ($this->courseCompletionService->courseHasFailedCompletions($course, $student)) {
            $this->icon = 2;

            return;
        }

        $this->icon = 3;
    }


    /**
     * Get the view / contents that represent the component.
     *
     * @return View|Closure|string
     */
    public function render()
    {
        return view('components.planning.completion');
    }
}
