<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    use HasFactory;


    public function flightsBookings()
    {
        return $this->hasMany(FlightsBooking::class);
    }


}
