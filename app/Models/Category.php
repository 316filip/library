<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // Relationship to assignments
    public function assignments()
    {
        return $this->hasMany(Assignment::class, 'category_id');
    }
}
