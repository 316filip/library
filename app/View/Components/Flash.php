<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Flash extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $color_bg, $color_text;
    public function __construct()
    {
        // Define colors based on received data
        if (session('color') == 'success') {
            $this->color_bg = 'sky-400';
            $this->color_text = 'white';
        } elseif (session('color') == 'fail') {
            $this->color_bg = 'red-500';
            $this->color_text = 'white';
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.flash');
    }
}
