<?php

namespace App\Http\Controllers;

use App\Models\CarBooking;
use Illuminate\Http\Request;

class CarBookingController extends Controller
{

    /**
     * @OA\Get(
     *     path="/api/car-bookings",
     *     tags={"Car Bookings"},
     *     summary="Get car bookings list",
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
    public function listCarBookings(Request $request): \Illuminate\Http\JsonResponse
    {
        $carBookings = CarBooking::all(); // Retrieve all car bookings from the database
        return response()->json($carBookings);
    }

}
