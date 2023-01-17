<?php

namespace App\View\Components;

use App\Models\Author;
use Illuminate\View\Component;

class Select extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $type, $values, $label, $placeholder, $search;
    public function __construct($type, $values)
    {
        $this->type = $type;
        $this->values = $values;

        if ($type == "author") {
            $this->label = "autor";
            $this->placeholder = "Neznámý";
            $this->search = "autory";
        } elseif ($type == "work") {
            $this->label = "titul";
            $this->placeholder = "Bible";
            $this->search = "díla";
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.select');
    }
}
