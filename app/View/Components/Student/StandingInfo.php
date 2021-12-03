<?php

namespace App\View\Components\Student;

use App\Models\Student;
use App\Services\Student\StudentCreditService;
use Carbon\Carbon;
use Illuminate\View\Component;

class StandingInfo extends Component
{
    public string $now;
    public string $studentsCredits;

    public function __construct(public Student $student, protected StudentCreditService $studentCreditService)
    {
        $this->now = Carbon::now()->format('d.m.Y H:i');
        $this->studentsCredits = $this->studentCreditService->getCreditsAsString($this->student);
    }

    public function render()
    {
        return view('components.student.standing-info');
    }
}
