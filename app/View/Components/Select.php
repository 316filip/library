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
    public $type, $name, $values, $label;
    public function __construct($type, $values)
    {
        $this->type = $type;
        $this->values = $values;

        if ($type == "author") {
            $this->name = "author_id";
            $this->label = "Autor";
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
