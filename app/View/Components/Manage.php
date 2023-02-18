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
    public $type, $id, $slug, $text, $link_edit, $link_delete;
    public function __construct($type, $identifier)
    {
        $this->type = $type;
        $this->id = $identifier;

        if ($type == 'author') {
            $this->text = 'autora';
            $this->link_edit = 'autor/' . $identifier[1];
            $this->link_delete = 'autor/' . $identifier[0];
        } elseif ($type == 'work') {
            $this->text = 'titul';
            $this->link_edit = 'titul/' . $identifier[1];
            $this->link_delete = 'titul/' . $identifier[0];
        } elseif ($type == 'book') {
            $this->text = 'knihu';
            $this->link_edit = 'kniha/' . $identifier[1] . '/' . $identifier[0];
            $this->link_delete = 'kniha/' . $identifier[0];
        } elseif ($type == 'user') {
            $this->text = 'účet';

            $link = '';
            if ($identifier[1] !== auth()->user()->id) {
                $link = '/' . $identifier[0];
            }

            $this->link_edit = 'ucet' . $link;
            $this->link_delete = 'ucet/' . $identifier[1];
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
