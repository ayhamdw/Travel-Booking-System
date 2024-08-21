<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HotelsBooking;

class HotelsBookingController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/hotel-bookings",
     *     tags={"Hotel Bookings"},
     *     summary="Get hotel bookings list",
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
    public function listHotelBookings(Request $request)
    {
        $hotelBookings = HotelsBooking::all(); // Retrieve all hotel bookings from the database
        return response()->json($hotelBookings);
    }
}
