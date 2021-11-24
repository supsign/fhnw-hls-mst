<?php

namespace App\View\Components\Student;

use App\Models\Student;
use Carbon\Carbon;
use Illuminate\View\Component;

class StandingInfo extends Component
{
    public string $now;

    public function __construct(public Student $student)
    {
        $this->now = Carbon::now()->format('d.m.Y H:i');
    }

    public function render()
    {
        return view('components.student.standing-info');
    }
}
