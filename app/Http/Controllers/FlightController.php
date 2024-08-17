<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use Illuminate\Http\Request;

class FlightController extends Controller
{
    public function getAllFlights () {
        $flights = Flight::all();
        return $flights;
}
}
