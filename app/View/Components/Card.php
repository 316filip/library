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
    public $type, $values, $classes, $title, $subtitle, $link, $overlay, $filter, $filter_text, $bookable, $available;
    public function __construct($type, $data, $number, $more)
    {
        if ($type == 'author') {
            $this->link = '/autor/' . $data['id'];
            $this->filter_text = "autorů";
        } elseif ($type == 'work') {
            $this->link = '/titul/' . $data['id'];
            $this->filter_text = "děl";
        } elseif ($type == 'book') {
            $this->link = '/kniha/' . $data['id'];
            $this->filter_text = "knih";
            $this->bookable = $data->date === true;
            $this->available = $data->book;

            if (auth()->check() && !auth()->user()->canBook) {
                $this->bookable = false;
            } elseif (auth()->check() && auth()->user()->bookings->contains('book_id', $data->id)) {
                $this->bookable = false;
                $this->available = 'booked';
            }
        } elseif ($type == 'user') {
            $this->link = '/ucet/' . $data['id'];
            $this->filter_text = "uživatelů";
        }

        $this->type = $type;
        $this->values = $data;
        $this->classes = ($number > 5 ? 'hidden' : 'block') . ($number > 7 ? ' md:hidden' : ' md:block') . ($number > 4 ? ' lg:hidden' : ' lg:block') . ($number > 5 ? ' xl:hidden' : ' xl:block');
        if ($more == 1) {
            $this->overlay = ($number != 5 ? ' hidden' : ' block') . ($number != 7 ? ' md:hidden' : ' md:block') . ($number != 4 ? ' lg:hidden' : ' lg:block') . ($number != 5 ? ' xl:hidden' : ' xl:block');
        } else {
            $this->overlay = 'hidden';
        }
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
