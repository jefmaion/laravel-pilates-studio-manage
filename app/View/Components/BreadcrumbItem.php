<?php

namespace App\View\Components;

use Illuminate\View\Component;

class BreadcrumbItem extends Component
{

    public $label;
    public $href;
    public $active;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($label=null, $href=null, $active=null)
    {
        $this->label  = $label;
        $this->href   = $href;
        $this->active = $active;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.breadcrumb-item');
    }
}
