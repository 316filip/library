<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    // Relationship to book
    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id');
    }
}
