<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Extend extends Component
{
    public $booking, $placement;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($data, $placement)
    {
        $this->booking = $data;
        $this->placement = $placement;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.extend');
    }
}
