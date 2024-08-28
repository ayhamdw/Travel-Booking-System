<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'location',
        'price_per_night',
        'description',
        'rating',
        'number_of_rooms_available',
        'thumbnail_url'
    ];

    public function hotelsBookings()
    {
        return $this->hasMany(HotelsBooking::class);
    }

    public function reviews()
    {
        return $this->morphMany(Review::class, 'reviewable');
    }

}
