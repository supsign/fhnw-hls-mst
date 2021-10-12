<?php

namespace App\View\Components\User;

use App\Models\Student;
use Illuminate\View\Component;

class Studentdata extends Component
{

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(protected ?Student $student = null)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        if(is_null($this->student))
        {
            return;
        }

        return view('components.user.studentdata', [
            'student' => $this->student,
        ]);
    }
}
