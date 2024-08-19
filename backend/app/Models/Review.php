<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'comment',
        'rating',
        'reviewable_type',
        'reviewable_id'
    ];

    public function reviewable()
    {
        return $this->morphTo();
    }


}

