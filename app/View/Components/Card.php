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
    public $classes, $title, $subtitle, $link, $overlay, $filter, $filter_text;
    public function __construct($type, $data, $number)
    {
        if ($type == 'author') {
            $this->title = ($data['name_prefix'] == '' ? '' : $data['name_prefix'] . ' ') . ($data['first_name'] == '' ? '' : $data['first_name'] . ' ') . ($data['middle_name'] == '' ? '' : $data['middle_name'] . ' ') . $data['last_name'] . ($data['name_suffix'] == '' ? '' : ' ' . $data['name_suffix']);
            $this->subtitle = '';
            $this->link = '/autor/' . $data['id'];
            $this->filter_text = "autorů";
        } elseif ($type == 'work') {
            $this->title = $data['title'];
            $this->subtitle = $data['subtitle'];
            $this->link = '/titul/' . $data['id'];
            $this->filter_text = "děl";
        } elseif ($type == 'book') {
            $this->title = $data['title'];
            $this->subtitle = $data['subtitle'];
            $this->link = '/kniha/' . $data['id'];
            $this->filter_text = "knih";
        }

        $this->classes = ($number > 5 ? ' hidden' : ' block') . ($number > 7 ? ' md:hidden' : ' md:block') . ($number > 4 ? ' lg:hidden' : ' lg:block') . ($number > 5 ? ' xl:hidden' : ' xl:block');
        $this->overlay = ($number < 5 ? ' hidden' : ' block') . ($number < 7 ? ' md:hidden' : ' md:block') . ($number < 4 ? ' lg:hidden' : ' lg:block') . ($number < 5 ? ' xl:hidden' : ' xl:block');
        $this->filter = $type;
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
