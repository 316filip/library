<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Image extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $type, $values, $placement;
    public function __construct($type, $data, $placement)
    {
        $this->type = $type;
        $this->values = $data;
        $this->placement = $placement;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.image');
    }
}
