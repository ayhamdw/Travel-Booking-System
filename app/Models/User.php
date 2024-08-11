<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

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
