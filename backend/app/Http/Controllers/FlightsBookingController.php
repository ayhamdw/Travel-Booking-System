<?php

namespace App\Http\Controllers;

use App\Models\CarBooking;
use App\Models\Flight;
use App\Models\FlightsBooking;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class FlightsBookingController extends Controller
{
    public function searchBookingFlights($id) {
        $flights = FlightsBooking::where('user_id' , $id)->get();
        if ($flights->isEmpty()) {
            return response()->json(['response'=>'Not Found'] , 404);
        }
        return $flights;
    }

    public function addBookingFlight(Request $request) {
        $validate = $request->validate([
            'user_id' => 'required|exists:users,id',
            'flight_id' => 'required|exists:flights,id',
        ]);
        try {
            $bookingFlight = DB::table('flights_bookings')->insert([
                'user_id' => $validate['user_id'],
                'flight_id' => $validate['flight_id'],
                'review_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            return response()->json(['message' => 'Booking Added Successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Booking could not be added', 'details' => $e->getMessage()], 500);
        }
    }


    public function addFlightReview(Request $request, $flightId, $userId)
    {
        $checkUserId = User::find($userId);
        if (!$checkUserId) {
            return response()->json(['error' => 'User not found'], 404);
        } else {
            $validated = $request->validate([
                'comment' => 'required|string',
                'rating' => 'required|integer|min:1|max:5',
            ]);

            try {
                // Create the review and get the ID of the newly created review
                $review = Review::create([
                    'comment' => $validated['comment'],
                    'rating' => $validated['rating'],
                    'reviewable_type' => 'App\Models\Flight',
                    'reviewable_id' => $flightId,
                ]);

                // Update the flight booking with the new review ID
                DB::table('flights_bookings')
                    ->where('user_id', $userId)
                    ->where('flight_id', $flightId) // Ensure you’re updating the correct booking
                    ->update(['review_id' => $review->id]);

                return response()->json(['response' => 'Review Added Successfully'], 200);
            } catch (\Exception $e) {
                // Return an error response
                return response()->json(['error' => 'Failed to add review', 'details' => $e->getMessage()], 500);
            }
        }
    }

}
