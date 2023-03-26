<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['name', 'slug', 'description'];

    /**
     * Relationship to assignments
     * 
     * @return object
     */
    public function assignments()
    {
        return $this->hasMany(Assignment::class, 'category_id');
    }
}
