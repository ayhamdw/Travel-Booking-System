<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    use HasFactory;

    protected $fillable = [
        'departure',
        'dest',
        'price',
        'seats_left',
        'description',
        'departure_date',
        'airline_name',
        'picture_url'
    ];

    public function flightsBookings()
    {
        return $this->hasMany(FlightsBooking::class);
    }

    public function reviews()
    {
        return $this->morphMany(Review::class, 'reviewable');
    }

}
