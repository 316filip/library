<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Author extends Model
{
    use HasFactory;

    // Relationship to works
    public function works()
    {
        return $this->hasMany(Work::class, 'author_id');
    }

    protected function name(): Attribute
    {
        return Attribute::make(
            fn () => $this->name_prefix . " " . $this->first_name . " " . $this->middle_name . " " . $this->last_name . " " . $this->name_suffix,
        );
    }
}
