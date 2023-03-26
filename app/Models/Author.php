<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Author extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['name_prefix', 'first_name', 'middle_name', 'last_name', 'name_suffix', 'slug', 'birth_date', 'death_date', 'description', 'image'];

    /**
     * Relationship to works
     * 
     * @return object
     */
    public function works()
    {
        return $this->hasMany(Work::class, 'author_id');
    }

    /**
     * Attribute containing full name
     * 
     * @return string
     */
    protected function name(): Attribute
    {
        return Attribute::make(
            fn () => ($this->name_prefix == "" ? "" : $this->name_prefix . " ") . $this->first_name . " " . ($this->middle_name == "" ? "" : $this->middle_name . " ") . $this->last_name . ($this->name_suffix == "" ? NULL : " " . $this->name_suffix),
        );
    }
}
