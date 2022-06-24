<?php

namespace App\View\Components\Student;

use App\Models\CourseGroupYear;
use App\Models\Student;
use App\Services\CourseGroupYear\CourseGroupYearService;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class StandingCourseGroup extends Component
{
    public bool $completed;
    public Collection $completions;
    public int $reachedCredits;

    public function __construct(
        public CourseGroupYear $courseGroupYear,
        public Student $student,
        protected CourseGroupYearService $courseGroupYearService
    ) {
        $this->completions = $this->getCompletions();
        $this->reachedCredits = $this->getCredit();
    }

    public function render()
    {
        if (!$this->courseGroupYearService->hasVisitedAtLeastOneCourse($this->courseGroupYear, $this->student)) {
            return;
        }

        return view('components.student.standing-course-group');
    }

    protected function getCompletions(): Collection
    {
        return $this->student->completions()->with([
            'courseYear',
            'courseYear.course',
        ])->where([
            'course_group_id' => $this->courseGroupYear->course_group_id,
        ])->get();
    }

    protected function getCredit(): int
    {
        $credits = $this->courseGroupYearService->getCredits($this->courseGroupYear, $this->student);

        foreach ($this->completions AS $completion) {
            $credits += $completion->credits;
        }

        $this->completed = $credits >= $this->courseGroupYear->credits_to_pass;

        return $credits;   
    }
}
