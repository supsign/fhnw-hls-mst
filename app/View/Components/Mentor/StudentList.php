<?php

namespace App\View\Components\Mentor;

use App\Models\Mentor;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class StudentList extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(public Mentor $mentor)
    {
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|Closure|string
     */
    public function render()
    {
        return view('components.mentor.student-list');
    }
}
