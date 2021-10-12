<?php

namespace App\View\Components\Planning;

use App\Models\Planning;
use App\Models\Student;
use App\Services\Student\StudentCreditService;
use Illuminate\View\Component;

class Completion extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(public Student $student, public Planning $planning)
    {
        $icon = 0;
        $completions = $student->completions;
        foreach ($completions as $completion) {
            if ($completion->completion_type_id === 2) {
                $icon = 2;
//                @dump('bestanden');
            } elseif ($completion->completion_type_id === 3) {
//                @dump('durchgefallen');
            } else {
//                @dump('rest');
            }
        }
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
