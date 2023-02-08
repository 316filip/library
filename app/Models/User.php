<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['first_name', 'last_name', 'email', 'code', 'admin', 'librarian', 'password'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Relationship to bookings
    public function bookings()
    {
        return $this->hasMany(Booking::class, 'user_id');
    }

    protected function name(): Attribute
    {
        return Attribute::make(
            fn ($value) => $this->first_name . " " . $this->last_name,
        );
    }

    protected function label(): Attribute
    {
        return Attribute::make(
            fn ($value) => $this->name . " (" . $this->code . ")",
        );
    }

    protected function canBook(): Attribute
    {
        return Attribute::make(
            fn ($value) => (count($this->bookings) < 6),
        );
    }
}
