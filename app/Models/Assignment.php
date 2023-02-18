<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;

    // Relationship to work
    public function work()
    {
        return $this->belongsTo(Work::class, 'work_id');
    }

    // Relationship to category
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
