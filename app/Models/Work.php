<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Work extends Model
{
    use HasFactory, Searchable;

    // Relationship to author
    public function author()
    {
        return $this->belongsTo(Author::class, 'author_id');
    }

    // Relationship to books
    public function books()
    {
        return $this->hasMany(Book::class, 'work_id');
    }

    // Define searchable fields
    public function toSearchableArray()
    {
        return [
            'title' => $this->title,
            'subtitle' => $this->subtitle
        ];
    }
}
