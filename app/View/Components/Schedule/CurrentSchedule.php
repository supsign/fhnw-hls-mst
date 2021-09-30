<?php

namespace App\View\Components\Schedule;

use App\Models\Schedule;
use Illuminate\View\Component;

class CurrentSchedule extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $modules;
    public function __construct($modules = ['Technik', 'Synthese & Analytik', 'Mathematik', 'Physik', 'Informatik', 'Biochemie'])
    {
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {

        return view('components.user.current-schedule');
    }
}
