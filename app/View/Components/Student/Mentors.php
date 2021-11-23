<?php

namespace App\View\Components\Student;

use App\Models\Mentor;
use App\Models\Student;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class Mentors extends Component
{
    public Collection $allMentors;
    public Collection $myMentors;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(public Student $student)
    {
        $this->allMentors = Mentor::all();

        $this->myMentors = $student->mentors;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|Closure|string
     */
    public function render()
    {
        if (!$this->student->id) {
            return null;
        }

        return view('components.student.mentors');
    }
}
