<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Car;
use App\Models\Flight;
use App\Models\Hotel;

class ReviewController extends Controller
{


    public function addCarReview(Request $request, $carId)
    {
 // لازم نرجع نعملها اختبار بس نخلص من login page
     //   $userId = Auth::id();

        $validated = $request->validate([
            'comment' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);

//        $carBooking = CarBooking::where('car_id', $carId)
//            ->where('user_id', $userId)
//            ->first();
//
//        if (!$carBooking) {
//            return response()->json(['error' => 'Car booking not found'], 404);
//        }

        // إنشاء التعليق
        $review = Review::create([
            'comment' => $validated['comment'],
            'rating' => $validated['rating'],
            'reviewable_type' => 'App\Models\Car',
            'reviewable_id' => $carId,
        ]);

        // ربط التعليق بحجز السيارة
       // $carBooking->update(['review_id' => $review->id]);

        return response()->json($review, 201);
    }


    public function addFlightReview(Request $request, $flightId)
    {
        $validated = $request->validate([
            'comment' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $review = Review::create([
            'comment' => $validated['comment'],
            'rating' => $validated['rating'],
            'reviewable_type' => 'App\Models\Flight',
            'reviewable_id' => $flightId,
        ]);

        return response()->json($review, 201);
    }

    public function addHotelReview(Request $request, $hotelId)
    {
        $validated = $request->validate([
            'comment' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $review = Review::create([
            'comment' => $validated['comment'],
            'rating' => $validated['rating'],
            'reviewable_type' => 'App\Models\Hotel',
            'reviewable_id' => $hotelId,
        ]);

        return response()->json($review, 201);
    }

    public function updateCarReview(Request $request, $reviewId)
    {
        $validated = $request->validate([
            'comment' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $review = Review::where('reviewable_type', 'App\Models\Car')
            ->findOrFail($reviewId);

        $review->update([
            'comment' => $validated['comment'],
            'rating' => $validated['rating'],
        ]);

        return response()->json($review, 200);
    }

    public function updateFlightReview(Request $request, $reviewId)
    {
        $validated = $request->validate([
            'comment' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $review = Review::where('reviewable_type', 'App\Models\Flight')
            ->findOrFail($reviewId);

        $review->update([
            'comment' => $validated['comment'],
            'rating' => $validated['rating'],
        ]);

        return response()->json($review, 200);
    }

    public function updateHotelReview(Request $request, $reviewId)
    {
        $validated = $request->validate([
            'comment' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $review = Review::where('reviewable_type', 'App\Models\Hotel')
            ->findOrFail($reviewId);

        $review->update([
            'comment' => $validated['comment'],
            'rating' => $validated['rating'],
        ]);

        return response()->json($review, 200);
    }

    public function deleteCarReview($reviewId)
    {
        $review = Review::where('reviewable_type', 'App\Models\Car')
            ->findOrFail($reviewId);

        $review->delete();

        return response()->json(['message' => 'Review deleted successfully.'], 200);
    }


    public function deleteFlightReview($reviewId)
    {
        $review = Review::where('reviewable_type', 'App\Models\Flight')
            ->findOrFail($reviewId);

        $review->delete();

        return response()->json(['message' => 'Review deleted successfully.'], 200);
    }


    public function deleteHotelReview($reviewId)
    {
        $review = Review::where('reviewable_type', 'App\Models\Hotel')
            ->findOrFail($reviewId);

        $review->delete();

        return response()->json(['message' => 'Review deleted successfully.'], 200);
    }


    public function getCarReviewStats($carId)
    {
        $car = Car::findOrFail($carId);

        $reviews = Review::where('reviewable_type', 'App\Models\Car')
            ->where('reviewable_id', $carId)
            ->get();

        $count = $reviews->count();
        $averageRating = $reviews->avg('rating');

        return response()->json([
            'car_id' => $carId,
            'number_of_reviews' => $count,
            'average_rating' => $averageRating,
        ], 200);
    }

    // Get the number of reviews and average rating for a flight
    public function getFlightReviewStats($flightId)
    {
        $flight = Flight::findOrFail($flightId);

        $reviews = Review::where('reviewable_type', 'App\Models\Flight')
            ->where('reviewable_id', $flightId)
            ->get();

        $count = $reviews->count();
        $averageRating = $reviews->avg('rating');

        return response()->json([
            'flight_id' => $flightId,
            'number_of_reviews' => $count,
            'average_rating' => $averageRating,
        ], 200);
    }

    // Get the number of reviews and average rating for a hotel
    public function getHotelReviewStats($hotelId)
    {
        $hotel = Hotel::findOrFail($hotelId);

        $reviews = Review::where('reviewable_type', 'App\Models\Hotel')
            ->where('reviewable_id', $hotelId)
            ->get();

        $count = $reviews->count();
        $averageRating = $reviews->avg('rating');

        return response()->json([
            'hotel_id' => $hotelId,
            'number_of_reviews' => $count,
            'average_rating' => $averageRating,
        ], 200);
    }

    public function getCarReviews($carId)
    {
        $car = Car::find($carId);

        if (!$car) {
            return response()->json(['error' => 'Car not found'], 404);
        }

        try {
            $carBookings = $car->carBookings()->with('review', 'user')->get();

            $reviews = $carBookings->map(function ($booking) {
                return [
                    'username' => $booking->user->username,
                    'comment' => $booking->review ? $booking->review->comment : null,
                    'rating' => $booking->review ? $booking->review->rating : null,
                ];
            });

            return response()->json($reviews);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }

    public function getHotelReviews($hotelId)
    {
        $hotel = Hotel::find($hotelId);

        if (!$hotel) {
            return response()->json(['error' => 'Hotel not found'], 404);
        }

        try {
            $hotelBookings = $hotel->hotelsBookings()->with('review', 'user')->get();

            $reviews = $hotelBookings->map(function ($booking) {
                return [
                    'username' => $booking->user->username,
                    'comment' => $booking->review ? $booking->review->comment : null,
                    'rating' => $booking->review ? $booking->review->rating : null,
                ];
            });

            return response()->json($reviews);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }


    public function getFlightReviews($flightId)
    {
        $flight = Flight::find($flightId);

        if (!$flight) {
            return response()->json(['error' => 'Flight not found'], 404);
        }

        try {
            $flightBookings = $flight->flightsBookings()->with('review', 'user')->get();

            $reviews = $flightBookings->map(function ($booking) {
                return [
                    'username' => $booking->user->username,
                    'comment' => $booking->review ? $booking->review->comment : null,
                    'rating' => $booking->review ? $booking->review->rating : null,
                ];
            });

            return response()->json($reviews);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }



    public function getAllCarReviewStats()
    {
        $cars = Car::all();

        if ($cars->isEmpty()) {
            return response()->json(['error' => 'No cars found.'], 404);
        }

        $carStats = $cars->map(function ($car) {
            $reviews = Review::where('reviewable_type', 'App\Models\Car')
                ->where('reviewable_id', $car->id)
                ->get();

            $count = $reviews->count();
            $averageRating = $reviews->avg('rating');

            return [
                'car' => [
                    'id' => $car->id,
                    'brand' => $car->brand,
                    'man_date' => $car->man_date,
                    'price_per_hour' => $car->price_per_hour,
                    'colour' => $car->colour,
                    'picture_url' => $car->picture_url,
                    'type' => $car->type,
                ],
                'number_of_reviews' => $count,
                'average_rating' => $averageRating,
            ];
        });

        return response()->json($carStats, 200);
    }

    public function getAllFlightReviewStats()
    {
        $flights = Flight::all();

        if ($flights->isEmpty()) {
            return response()->json(['error' => 'No flights found.'], 404);
        }

        $flightStats = $flights->map(function ($flight) {
            $reviews = Review::where('reviewable_type', 'App\Models\Flight')
                ->where('reviewable_id', $flight->id)
                ->get();

            $count = $reviews->count();
            $averageRating = $reviews->avg('rating');

            return [
                'flight' => [
                    'id' => $flight->id,
                    'flight_number' => $flight->flight_number,
                    'departure_date' => $flight->departure_date,
                    'arrival_date' => $flight->arrival_date,
                    'price' => $flight->price,
                    'airline' => $flight->airline,
                ],
                'number_of_reviews' => $count,
                'average_rating' => $averageRating,
            ];
        });

        return response()->json($flightStats, 200);
    }
    public function getAllHotelReviewStats()
    {
        $hotels = Hotel::all();

        if ($hotels->isEmpty()) {
            return response()->json(['error' => 'No hotels found.'], 404);
        }

        $hotelStats = $hotels->map(function ($hotel) {
            $reviews = Review::where('reviewable_type', 'App\Models\Hotel')
                ->where('reviewable_id', $hotel->id)
                ->get();

            $count = $reviews->count();
            $averageRating = $reviews->avg('rating');

            return [
                'hotel' => [
                    'id' => $hotel->id,
                    'name' => $hotel->name,
                    'location' => $hotel->location,
                    'price_per_night' => $hotel->price_per_night,
                    'rating' => $hotel->rating,
                    'picture_url' => $hotel->picture_url,
                ],
                'number_of_reviews' => $count,
                'average_rating' => $averageRating,
            ];
        });

        return response()->json($hotelStats, 200);
    }
}



