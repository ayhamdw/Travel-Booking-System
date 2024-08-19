<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use Illuminate\Http\Request;
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
}
