<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['code', 'book_id', 'user_id', 'from', 'to', 'borrowed', 'returned'];

    /**
     * Relationship to book
     * 
     * @return object
     */
    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id');
    }

    /**
     * Relationship to user
     * 
     * @return object
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Attribute indicating wether it's late to return or not
     * 
     * @return bool
     */
    protected function late(): Attribute
    {
        if (date_diff(now('Europe/Prague'), date_create($this->to))->format("%R") == "+" || $this->returned) {
            $late = false;
        } else {
            $late = true;
        }
        return Attribute::make(
            fn ($value) => $late,
        );
    }

    /**
     * Attribute indicating state of the booking
     * 
     * @return string
     */
    protected function until(): Attribute
    {
        $number = date_diff(now('Europe/Prague'), date_create($this->to))->format("%a");
        if ($this->late) {
            $text = "Před";
            $days = $number == 1 ? "dnem" : "dny";
        } elseif ($this->returned) {
            if ($this->borrowed) {
                $text = "Vrácena";
            } else {
                $text = "Nebyla vypůjčena";
            }
            $number = "";
            $days = "";
        } elseif (!$this->borrowed) {
            $text = "Čeká na vyzvednutí...";
            $number = "";
            $days = "";
        } else {
            $text = "Za";
            $days = $number == 1 ? "den" : ($number > 1 && $number < 5 ? "dny" : "dní");
        }
        return Attribute::make(
            fn ($value) => $text . " " . $number . " " . $days,
        );
    }

    /**
     * Attribute indicating wether the booking can be extended or not
     * 
     * @return string
     */
    protected function extendable(): Attribute
    {
        $extendable = false;
        if (date_diff(date_create($this->from), date_create($this->to))->format('%a') > 40 || $this->late || $this->returned || !$this->borrowed) {
            $extendable = 'hide';
        } elseif (date_diff(now('Europe/Prague'), date_create($this->to))->format('%a') < 16) {
            $extendable = true;
        }

        return Attribute::make(
            fn ($value) => $extendable,
        );
    }
}
