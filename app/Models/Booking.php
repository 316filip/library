<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
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
}
