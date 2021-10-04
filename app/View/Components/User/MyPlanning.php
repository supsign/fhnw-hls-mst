<?php

namespace App\View\Components\User;

use App\Models\Planning;
use Illuminate\View\Component;

class MyPlanning extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
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
        return view('components.user.my-planning', [
            'plannings' => Planning::with('studyFieldYear')->get(),
        ]);
    }
}
