<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ButtonLink extends Component
{

    public $label;
    public $url;
    public $theme;
    public $icon;
    public $class;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($label='', $theme='', $url='', $icon='', $class='')
    {
        $this->label = $label;
        $this->theme = $theme;
        $this->url = $url;
        $this->icon = $icon;
        $this->class = $class;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.button-link');
    }
}
