<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
    use HasFactory;

    protected $fillable = ['work_id', 'title', 'subtitle', 'length', 'language', 'translator', 'illustrator', 'description', 'house', 'year', 'publication', 'place', 'image', 'ISBN', 'amount'];

    // Relationship to work
    public function work()
    {
        return $this->belongsTo(Work::class, 'work_id');
    }

    // Relationship to bookings
    public function bookings()
    {
        return $this->hasMany(Booking::class, 'book_id');
    }

    // Attribute containing information about availability
    protected function date(): Attribute
    {
        $bookings = $this->bookings->sortByDesc('to')->take($this->amount);
        $sorted = $bookings->sortBy('to');
        $date = false;
        $booked = 0;
        foreach ($sorted as $booking) {
            $diff = date_diff(date_create(date('Y-m-d')), date_create($booking->to))->format("%R%a");
            if ($booking->returned === 1) {
                $date = true;
                continue;
            } elseif ($diff < 6) {
                $booked += 1;
                if ($date !== true) $date = "soon";
            } elseif ($diff < 15) {
                $booked += 1;
                if ($date !== true && $date !== "soon" && ($date === false || date_diff($date, $booking->to)->format('%R%a') > 0)) $date = $booking->to;
            } else {
                $booked += 1;
                $date = false;
            }
        }
        if ($this->amount > $booked) {
            $date = true;
        }
        return Attribute::make(
            fn () => $date,
        );
    }
}
