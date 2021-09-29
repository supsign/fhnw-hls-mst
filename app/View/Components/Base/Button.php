<?php

namespace App\View\Components\Base;

use Illuminate\View\Component;

class Button extends Component
{
    public $disabled;

    public function withAttributes(array $attributes)
    {
        if ($this->disabled) {
            unset($attributes['href']);
        }

        return parent::withAttributes($attributes);
    }

    public function __construct(bool $disabled = false)
    {
        $this->disabled = $disabled;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.base.button');
    }
}
