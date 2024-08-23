<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HotelsBooking;
use Illuminate\Support\Facades\DB;

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

    public function getHotelBookings(Request $request) {
        $validate = $request->validate([
            'user_id' => 'required',
        ]);

        $hotelBookings = DB::table('hotels_bookings')
            ->join('hotels', 'hotels.id', '=', 'hotels_bookings.hotel_id')
            ->join('users', 'users.id', '=', 'hotels_bookings.user_id')
            ->where('hotels_bookings.user_id', $validate['user_id'])
            ->select('hotels.*')
            ->get();

        return response()->json($hotelBookings);
    }

}
