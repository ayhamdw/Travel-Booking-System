<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelsBooking extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'hotel_id',
        'review_id',
        'start_date',
        'end_date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }

    public function review()
    {

            return $this->belongsTo(Review::class, 'review_id');

    }

}
