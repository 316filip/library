<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['work_id', 'category_id'];

    /**
     * Relationship to work
     * 
     * @return object
     */
    public function work()
    {
        return $this->belongsTo(Work::class, 'work_id');
    }

    /**
     * Relationship to category
     * 
     * @return object
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
