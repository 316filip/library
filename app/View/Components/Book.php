<?php

namespace App\View\Components;

use App\Models\User;
use Illuminate\View\Component;

class Book extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $users, $book, $bookable, $available, $placement;
    public function __construct($data, $placement)
    {
        $this->users = User::orderBy('last_name')->get();
        $this->book = $data;
        $this->bookable = $data->date === true;
        $this->available = $data->date;
        $this->placement = $placement;

        if (auth()->check() && !auth()->user()->canBook) {
            $this->bookable = false;
        } elseif (auth()->check() && auth()->user()->bookings->contains(function ($val) use ($data) {
            return $val->book_id == $data->id && !$val->returned;
        })) {
            $this->bookable = false;
            $this->available = 'booked';
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.book');
    }
}
