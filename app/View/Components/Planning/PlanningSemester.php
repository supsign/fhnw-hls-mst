<?php

namespace App\View\Components\Planning;

use App\Models\Planning;
use Illuminate\View\Component;

class PlanningSemester extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(public Planning $planning)
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
        return view('components.planning.planning-semester', [
            'planning' => $this->planning,
        ]);
    }
}
