<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use Illuminate\Support\Facades\DB;

class FlightController extends Controller
{
    public function searchAll () {
        $flights = Flight::all();
        return $flights;
    }

    public function search ($from, $to, $departure) {
        $flights = DB::table("flights")
            ->where('departure' , $from)
            ->where('dest' , $to)
            ->where('departure_date' , $departure)
            ->get();
        return $flights;
    }

    public function flightReview($flightId)
    {
        $flightReview = DB::table('flights')
            ->join('reviews', 'reviews.reviewable_id', '=', 'flights.id') // Corrected the join condition
            ->where('reviews.reviewable_type', 'App\Models\Flight')
            ->where('reviews.reviewable_id', $flightId) // Add this to filter reviews by flight ID
            ->select('reviews.comment', 'reviews.rating', 'reviews.updated_at')
            ->get();

        return $flightReview; // Ensure the results are returned
    }
}
