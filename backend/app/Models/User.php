<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'username',
        'password',
        'email',
        'first_name',
        'last_name',
        'role'
    ];
    
    protected $hidden = [
        'password',
    ];

    public function carBookings()
    {
        return $this->hasMany(CarBooking::class);
    }

    public function flightsBookings()
    {
        return $this->hasMany(FlightsBooking::class);
    }

    public function hotelsBookings()
    {
        return $this->hasMany(HotelsBooking::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
