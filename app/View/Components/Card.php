<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Card extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $title, $subtitle, $link;
    public function __construct($data, $type)
    {
        if ($type == 'author') {
            $this->title = ($data['name_prefix'] == '' ? '' : $data['name_prefix'] . ' ') . ($data['first_name'] == '' ? '' : $data['first_name'] . ' ') . ($data['middle_name'] == '' ? '' : $data['middle_name'] . ' ') . $data['last_name'] . ($data['name_suffix'] == '' ? '' : ' ' . $data['name_suffix']);
            $this->subtitle = '';
            $this->link = '/autor/' . $data['id'];
        } elseif ($type == 'work') {
            $this->title = $data['title'];
            $this->subtitle = $data['subtitle'];
            $this->link = '/knihovna/' . $data['id'];
        } elseif ($type == 'book') {
            $this->title = $data['title'];
            $this->subtitle = $data['subtitle'];
            $this->link = '/kniha/' . $data['id'];
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.card');
    }
}
