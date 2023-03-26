<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Mail\PasswordReset;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Mail;
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

    /**
     * Relationship to bookings
     * 
     * @return object
     */
    public function bookings()
    {
        return $this->hasMany(Booking::class, 'user_id');
    }

    /**
     * Attribute containing user's full name
     * 
     * @return string
     */ 
    protected function name(): Attribute
    {
        return Attribute::make(
            fn ($value) => $this->first_name . " " . $this->last_name,
        );
    }

    /**
     * Attribute containing user's full name and code
     * 
     * @return string
     */ 
    protected function label(): Attribute
    {
        return Attribute::make(
            fn ($value) => $this->name . " (" . $this->code . ")",
        );
    }

    /**
     * Attribute indicating wether user can book or not
     * 
     * @return bool
     */ 
    protected function canBook(): Attribute
    {
        return Attribute::make(
            fn ($value) => ((count($this->bookings) < 5) || $this->librarian),
        );
    }

    /**
     * Mails user his password reset link
     * 
     * @param string
     */ 
    public function sendPasswordResetNotification($token)
    {
        Mail::to($this->email)->send(new PasswordReset($token, $this->email));
    }
}
