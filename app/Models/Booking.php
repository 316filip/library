<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'book_id', 'user_id', 'from', 'to', 'borrowed', 'returned'];

    // Relationship to book
    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id');
    }

    // Relationship to user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

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

    protected function until(): Attribute
    {
        $number = date_diff(now('Europe/Prague'), date_create($this->to))->format("%d");
        if ($this->late) {
            $text = "Skončila před";
            $days = $number == 1 ? "dnem" : "dny";
        } elseif ($this->returned) {
            $text = "Vrácena";
            $number = "";
            $days = "";
        } else {
            $text = "Skončí za";
            $days = $number == 1 ? "den" : ($number > 1 && $number < 5 ? "dny" : "dní");
        }
        return Attribute::make(
            fn ($value) => $text . " " . $number . " " . $days,
        );
    }
}
