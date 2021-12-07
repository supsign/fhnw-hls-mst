<?php

namespace App\View\Components\User;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class MyPlanning extends Component
{

    public Collection $plannings;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $student = Auth::user()->student;
        $this->plannings = $student->plannings->load('studyFieldYear');
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|Closure|string
     */
    public function render()
    {
        return view('components.user.my-planning', [
            'plannings' => $this->plannings,
        ]);
    }
}
