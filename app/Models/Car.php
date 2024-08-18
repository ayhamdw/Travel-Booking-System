<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;
    protected $fillable = [
        'brand',
        'man_date',
        'price_per_hour',
        'colour',
        'picture_url',
        'type'
    ];

    public function reviews()
    {
        return $this->morphMany(Review::class, 'reviewable');
    }

    public function carBookings()
    {
        return $this->hasMany(CarBooking::class);
    }


}
