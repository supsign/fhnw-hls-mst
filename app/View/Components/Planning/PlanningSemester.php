<?php

namespace App\View\Components\Planning;

use App\Models\Planning;
use App\Models\Semester;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class PlanningSemester extends Component
{
    public Collection $semesters;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(public Planning $planning)
    {
        $this->semesters = Semester::orderBy('year')->orderBy('is_hs')->get();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.planning.planning-semester', [
            'planning' => $this->planning,
        ]);
    }
}
