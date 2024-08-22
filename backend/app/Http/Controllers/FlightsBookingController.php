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
                $review = Review::create([
                    'comment' => $validated['comment'],
                    'rating' => $validated['rating'],
                    'reviewable_type' => 'App\Models\Flight',
                    'reviewable_id' => $flightId,
                ]);

                DB::table('flights_bookings')
                    ->where('user_id', $userId)
                    ->where('flight_id', $flightId) // Ensure you’re updating the correct booking
                    ->update(['review_id' => $review->id]);

                return response()->json(['response' => 'Review Added Successfully'], 200);
            } catch (\Exception $e) {
                return response()->json(['error' => 'Failed to add review', 'details' => $e->getMessage()], 500);
            }
        }
    }

    public function editBookingFlight(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'flight_id' => 'required|exists:flights,id',
        ]);

        $bookingId = FlightsBooking::where('user_id' , $validated['user_id'])
            ->where('flight_id', $validated['flight_id'])->first()->id;
        try {
            $updated = DB::table('flights_bookings')
                ->where('id', $bookingId)
                ->update([
                    'flight_id' => $validated['flight_id'],
                    'updated_at' => now(),
                ]);

            if ($updated) {
                return response()->json(['response' => 'Booking Updated Successfully'], 200);
            } else {
                return response()->json(['error' => 'Booking Not Found or No Changes'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update booking', 'details' => $e->getMessage()], 500);
        }
    }

    public function editReviewFlight(Request $request, $reviewId)
    {
        $validated = $request->validate([
            'comment' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        try {
            $updated = DB::table('reviews')
                ->where('id', $reviewId)
                ->update([
                    'comment' => $validated['comment'],
                    'rating' => $validated['rating'],
                    'updated_at' => now(),
                ]);

            if ($updated) {
                return response()->json(['response' => 'Review Updated Successfully'], 200);
            } else {
                return response()->json(['error' => 'Review Not Found or No Changes'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update review', 'details' => $e->getMessage()], 500);
        }
    }
    public function deleteBookingFlight($bookingId)
    {
        try {
            $deleted = DB::table('flights_bookings')
                ->where('id', $bookingId)
                ->delete();

            if ($deleted) {
                return response()->json(['response' => 'Booking Deleted Successfully'], 200);
            } else {
                return response()->json(['error' => 'Booking Not Found'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete booking', 'details' => $e->getMessage()], 500);
        }
    }

    public function deleteReviewFlight($reviewId)
    {
        try {
            $deleted = DB::table('reviews')
                ->where('id', $reviewId)
                ->delete();

            if ($deleted) {
                return response()->json(['response' => 'Review Deleted Successfully'], 200);
            } else {
                return response()->json(['error' => 'Review Not Found'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete review', 'details' => $e->getMessage()], 500);
        }
    }

}
