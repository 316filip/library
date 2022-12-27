<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

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
}
