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
        $date = true;
        foreach ($sorted as $booking) {
            $diff = date_diff(date_create(date('Y-m-d')), date_create($booking->to))->format("%R%a");
            if ($booking->returned === 1) {
                $date = true;
                continue;
            } elseif ($diff < 15 && $diff > 5) {
                $date = $booking->to;
            }
        }
        if ($this->amount === 0) {
            $date = false;
        }
        return Attribute::make(
            fn () => $date,
        );
    }
}
