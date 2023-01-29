<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Delete extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $id, $text, $link;
    public function __construct($id, $type)
    {
        $this->id = $id;
        if ($type == 'author') {
            $this->text = "autora";
            $this->link = "autor";
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.delete');
    }
}
