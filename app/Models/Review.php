<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    public function carBooking()
    {
        return $this->hasOne(CarBooking::class);
    }

    public function flightsBooking()
    {
        return $this->hasOne(FlightsBooking::class);
    }

    public function hotelsBooking()
    {
        return $this->hasOne(HotelsBooking::class);
    }
}

