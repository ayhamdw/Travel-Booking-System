<?php

namespace App\Http\Controllers;

use App\Models\CarBooking;
use App\Models\Flight;
use App\Models\FlightsBooking;
use Illuminate\Http\Request;
use App\Models\FlightsBooking;




class FlightsBookingController extends Controller
{
    public function searchBookingFlights($id) {
        $flights = FlightsBooking::where('user_id' , $id)->get();
        if ($flights->isEmpty()) {
            return response()->json(['response'=>'Not Found'] , 404);
        }
        return $flights;
    }

    public function addBookingFlight (Request $request) {
        
    }
}
