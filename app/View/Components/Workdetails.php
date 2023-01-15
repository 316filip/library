<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Workdetails extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $work;
    public function __construct($work)
    {
        $this->work = $work;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.workdetails');
    }
}
