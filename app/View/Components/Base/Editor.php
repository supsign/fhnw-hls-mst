<?php

namespace App\View\Components\Base;

use Illuminate\View\Component;

class Editor extends Component
{
    public $initError;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(public $validationRules = null, $initErrors = null, public $tooltipp = null)
    {
        if (isset($initErrors[0])) {
            $this->initError = $initErrors[0];
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.base.editor');
    }
}
