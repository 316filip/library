<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Author extends Model
{
    use HasFactory, Searchable;

    // Relationship to works
    public function works()
    {
        return $this->hasMany(Work::class, 'author_id');
    }

    // Define searchable fields
    public function toSearchableArray()
    {
        return [
            'name' => $this->name
        ];
    }
}
