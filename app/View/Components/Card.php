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
    public $type, $values, $placement, $classes, $title, $subtitle, $link, $overlay, $filter, $query, $in, $filter_text, $bookable, $available;
    public function __construct($data, $info)
    {
        $type = $info[0];
        $number = $info[1];
        $filter = $info[2];
        $query = $info[3];

        $this->type = $type;
        $this->values = $data;
        $this->classes = (($number > 3 && ($type == 'book' || $type == 'work' || $type == 'booking') || $number > 5 && ($type == 'author' || $type == 'user')) ? 'hidden' : 'block') . ($number > 5 ? ' min-[470px]:hidden' : ' min-[470px]:block') . ($number > 5 ? ' md:hidden' : ' md:block') . ($number > 7 ? ' lg:hidden' : ' lg:block') . ($number > 4 ? ' xl:hidden' : ' xl:block') . ($number > 5 ? ' 2xl:hidden' : ' 2xl:block');
        $this->overlay = (($number != 3 && ($type == 'book' || $type == 'work' || $type == 'booking') || $number != 5 && ($type == 'author' || $type == 'user')) ? ' hidden' : ' block') . ($number != 5 ? ' min-[470px]:hidden' : ' min-[470px]:block') . ($number != 5 ? ' md:hidden' : ' md:block') . ($number != 7 ? ' lg:hidden' : ' lg:block') . ($number != 4 ? ' xl:hidden' : ' xl:block') . ($number != 5 ? ' 2xl:hidden' : ' 2xl:block');
        $this->filter = $filter;
        $this->query = ($query == '') ? '' : '&query=' . $query;
        $this->in = ($filter == 'search') ? '&in=' . $type : '';

        if ($type == 'author') {
            $this->link = '/autor/' . $data->slug;
            $this->filter_text = "autorů";
        } elseif ($type == 'work') {
            $this->link = '/titul/' . $data->slug;
            $this->filter_text = "děl";
        } elseif ($type == 'book') {
            $this->link = '/kniha/' . $data->work->slug . '/' . $data->id;
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
            $this->link = '/ucet/' . $data['code'];
            $this->filter_text = "uživatelů";
        } elseif ($type == 'booking') {
            $this->link = '/rezervace/' . $data['code'];
            $this->filter_text = "rezervací";
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
