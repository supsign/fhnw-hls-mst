<?php

namespace App\View\Components\Planning;

use App\Models\Planning;
use App\View\Components\User\MyPlanning;
use Illuminate\View\Component;

class SingleItem extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(public Planning $planning)
    {
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.planning.single-item');
    }
}
