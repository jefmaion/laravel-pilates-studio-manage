<?php

namespace App\View\Components;

use Illuminate\View\Component;

class RowMenu extends Component
{

    public $dataId;
    public $urlEdit;
    public $urlDelete;
    public $others;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($dataId=0, $urlEdit='', $urlDelete='', $others=[])
    {
        $this->dataId = $dataId;
        $this->urlEdit = $urlEdit;
        $this->urlDelete= $urlDelete;
        $this->others = $others;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.row-menu');
    }
}
