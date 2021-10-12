<?php

namespace App\View\Components\User;

use App\Models\Student;
use App\Services\Student\StudentCreditService;
use Auth;
use Illuminate\View\Component;

class Studentdata extends Component
{
    public $studentCredits;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(protected ?Student $student = null, StudentCreditService $studentCreditService)
    {
        $user = Auth::user();
        $this->studentCredits = $studentCreditService->getCreditsAsString($user->student);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        if (is_null($this->student)) {
            return;
        }

        return view('components.user.studentdata', [
            'student' => $this->student,
        ]);
    }
}
