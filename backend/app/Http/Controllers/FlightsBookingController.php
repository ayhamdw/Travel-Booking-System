<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use Illuminate\Http\Request;
use App\Models\FlightsBooking;




class FlightsBookingController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/flight-bookings",
     *     tags={"Flight Bookings"},
     *     summary="Get flight bookings list",
     *     security={
     *         {"passport": {}},
     *     },
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation"
     *     ),
     *     @OA\Response(
     *         response="default",
     *         description="An unexpected error occurred"
     *     )
     * )
     */
    public function listFlightBookings(Request $request): \Illuminate\Http\JsonResponse
    {
        $flightBookings = FlightsBooking::all(); // Retrieve all flight bookings from the database
        return response()->json($flightBookings);
    }
}
