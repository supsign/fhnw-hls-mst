<?php

namespace App\View\Components\User;

use Illuminate\View\Component;

class CurrentSchedule extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(public array $modules = ['Technik', 'Synthese & Analytik', 'Mathematik', 'Physik', 'Informatik', 'Biochemie'])
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
        return view('components.user.current-schedule');
    }
}
