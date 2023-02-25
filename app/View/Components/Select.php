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
    public $type, $id_value, $name_value, $values, $label, $placeholder, $search, $id;
    public function __construct($type, $target, $values, $identifier)
    {
        $this->type = $type;
        $this->values = $values;
        $this->id = $identifier;

        if ($type == "author") {
            $this->label = "autor";
            $this->placeholder = "Neznámý autor";
            $this->search = "autory";
        } elseif ($type == "work") {
            $this->label = "titul";
            $this->placeholder = "Bible";
            $this->search = "díla";
        } elseif ($type == "user") {
            $this->label = "rezervovat pro uživatele...";
            $this->placeholder = "Jan Srna";
            $this->search = "uživatele";
        } elseif ($type == "category") {
            $this->label = "kategorie";
            $this->placeholder = "Přidat kategorie...";
            $this->search = "kategorie";
        }

        if ($target !== []) {
            $this->id_value = old($type . '_id') ?? $target[0];
            $this->name_value = old($type) ?? $target[1];
        } elseif ($type == 'user') {
            $this->id_value = old($type . '_id') ?? auth()->user()->id;
            $this->name_value = old($type) ?? auth()->user()->label;
        } else {
            $this->id_value = old($type . '_id');
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
