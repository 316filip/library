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
    public $type, $id_value, $name_value, $values, $label, $placeholder, $search;
    public function __construct($type, $target, $values)
    {
        $this->type = $type;
        $this->values = $values;

        if ($type == "author") {
            $this->label = "autor";
            $this->placeholder = "Neznámý autor";
            $this->search = "autory";
        } elseif ($type == "work") {
            $this->label = "titul";
            $this->placeholder = "Bible";
            $this->search = "díla";
        }

        if ($target !== "") {
            $this->id_value = old($type . "_id") == '' ? $target : old($type . "_id");
            if ($type == "author") $this->name_value = old($type) == '' ? $values->firstWhere('id', $target)->name : old($type);
            elseif ($type == "work") $this->name_value = old($type) == '' ? $values->firstWhere('id', $target)->title : old($type);
        } else {
            $this->id_value = old($type . "_id");
            $this->name_value = old($type);
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
