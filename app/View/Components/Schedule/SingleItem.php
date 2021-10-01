<?php

namespace App\View\Components\Schedule;

use App\Models\Schedule;
use Illuminate\View\Component;

class SingleItem extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.schedule.single-item');
    }
}
