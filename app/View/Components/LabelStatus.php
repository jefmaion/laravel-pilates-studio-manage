<?php

namespace App\View\Components;

use Illuminate\View\Component;

class LabelStatus extends Component
{

    public $label;
    public $theme;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($label='', $theme='')
    {
        $this->label = $label;
        $this->theme = $theme;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.label-status');
    }
}
