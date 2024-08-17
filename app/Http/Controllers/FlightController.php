<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use Illuminate\Http\Request;

class FlightController extends Controller
{
    public function searchAll () {
        $flights = Flight::all();
        return $flights;
    }
}
