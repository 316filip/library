<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Manage extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $type, $id, $text, $link;
    public function __construct($type, $identifier)
    {
        $this->type = $type;
        $this->id = $identifier;

        if ($type == 'author') {
            $this->text = 'autora';
            $this->link = 'autor';
        } elseif ($type == 'work') {
            $this->text = 'titul';
            $this->link = 'titul';
        } elseif ($type == 'book') {
            $this->text = 'knihu';
            $this->link = 'kniha';
        } elseif ($type == 'user') {
            $this->text = 'účet';
            $this->link = 'ucet';
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.manage');
    }
}
