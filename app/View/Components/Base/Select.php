<?php

namespace App\View\Components\Base;

use Illuminate\View\Component;

class Select extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $options;
    public $optionKey;
    public $label;
    public $value;
    public $initError;
    public $name;

    public function __construct(
        $options = null,
        $optionKey = 'id',
        $label = null,
        $value = null,
        $initErrors = null
    ) {
        if(isset($options)) {
            $this->options = $options->values();
        }
        $this->optionKey = $optionKey;
        $this->label = $label;
        $this->value = $value;
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
        return view('components.base.select');
    }
}
