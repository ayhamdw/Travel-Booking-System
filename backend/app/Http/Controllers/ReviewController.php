<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Car;
use App\Models\Flight;
use App\Models\Hotel;


/**
 * @OA\Info(
 *     title="Travel Booking System API",
 *     version="1.0.0",
 *     description="API documentation for the Travel Booking System project.",
 *     @OA\Contact(
 *         email="support@example.com"
 *     )
 * )
 */
class ReviewController extends Controller
{
    /**
     * @OA\Post(
     *     path="/cars/{carId}/reviews",
     *     summary="Add a review for a car",
     *     tags={"Reviews"},
     *     @OA\Parameter(
     *         name="carId",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *         description="ID of the car"
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"comment", "rating"},
     *             @OA\Property(property="comment", type="string", example="Great car!"),
     *             @OA\Property(property="rating", type="integer", example=5)
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Review created successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="id", type="integer"),
     *             @OA\Property(property="comment", type="string"),
     *             @OA\Property(property="rating", type="integer"),
     *             @OA\Property(property="reviewable_type", type="string"),
     *             @OA\Property(property="reviewable_id", type="integer")
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid input"
     *     )
     * )
     */

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

    /**
     * @OA\Post(
     *     path="/flights/{flightId}/reviews",
     *     summary="Add a review for a flight",
     *     tags={"Reviews"},
     *     @OA\Parameter(
     *         name="flightId",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *         description="ID of the flight"
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"comment", "rating"},
     *             @OA\Property(property="comment", type="string", example="Amazing flight!"),
     *             @OA\Property(property="rating", type="integer", example=4)
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Review created successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="id", type="integer"),
     *             @OA\Property(property="comment", type="string"),
     *             @OA\Property(property="rating", type="integer"),
     *             @OA\Property(property="reviewable_type", type="string"),
     *             @OA\Property(property="reviewable_id", type="integer")
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid input"
     *     )
     * )
     */
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

    /**
     * @OA\Post(
     *     path="/hotels/{hotelId}/reviews",
     *     summary="Add a review for a hotel",
     *     tags={"Reviews"},
     *     @OA\Parameter(
     *         name="hotelId",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *         description="ID of the hotel"
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"comment", "rating"},
     *             @OA\Property(property="comment", type="string", example="Nice hotel!"),
     *             @OA\Property(property="rating", type="integer", example=3)
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Review created successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="id", type="integer"),
     *             @OA\Property(property="comment", type="string"),
     *             @OA\Property(property="rating", type="integer"),
     *             @OA\Property(property="reviewable_type", type="string"),
     *             @OA\Property(property="reviewable_id", type="integer")
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid input"
     *     )
     * )
     */
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
    /**
     * @OA\Put(
     *     path="/reviews/cars/{reviewId}",
     *     summary="Update a car review",
     *     tags={"Reviews"},
     *     @OA\Parameter(
     *         name="reviewId",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *         description="ID of the review"
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"comment", "rating"},
     *             @OA\Property(property="comment", type="string", example="Updated review comment"),
     *             @OA\Property(property="rating", type="integer", example=4)
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Review updated successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="id", type="integer"),
     *             @OA\Property(property="comment", type="string"),
     *             @OA\Property(property="rating", type="integer"),
     *             @OA\Property(property="reviewable_type", type="string"),
     *             @OA\Property(property="reviewable_id", type="integer")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Review not found"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid input"
     *     )
     * )
     */
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
    /**
     * @OA\Put(
     *     path="/reviews/flights/{reviewId}",
     *     summary="Update a flight review",
     *     tags={"Reviews"},
     *     @OA\Parameter(
     *         name="reviewId",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *         description="ID of the review"
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"comment", "rating"},
     *             @OA\Property(property="comment", type="string", example="Updated review comment"),
     *             @OA\Property(property="rating", type="integer", example=4)
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Review updated successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="id", type="integer"),
     *             @OA\Property(property="comment", type="string"),
     *             @OA\Property(property="rating", type="integer"),
     *             @OA\Property(property="reviewable_type", type="string"),
     *             @OA\Property(property="reviewable_id", type="integer")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Review not found"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid input"
     *     )
     * )
     */
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
    /**
     * @OA\Put(
     *     path="/reviews/hotels/{reviewId}",
     *     summary="Update a hotel review",
     *     tags={"Reviews"},
     *     @OA\Parameter(
     *         name="reviewId",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *         description="ID of the review"
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"comment", "rating"},
     *             @OA\Property(property="comment", type="string", example="Updated review comment"),
     *             @OA\Property(property="rating", type="integer", example=4)
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Review updated successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="id", type="integer"),
     *             @OA\Property(property="comment", type="string"),
     *             @OA\Property(property="rating", type="integer"),
     *             @OA\Property(property="reviewable_type", type="string"),
     *             @OA\Property(property="reviewable_id", type="integer")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Review not found"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid input"
     *     )
     * )
     */
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

    /**
     * @OA\Delete(
     *     path="/Delete/reviews/cars/{reviewId}",
     *     summary="Delete a review",
     *     tags={"Reviews"},
     *     @OA\Parameter(
     *         name="reviewId",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *         description="ID of the review"
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Review deleted successfully"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Review not found"
     *     )
     * )
     */
    public function deleteCarReview($reviewId)
    {
        $review = Review::where('reviewable_type', 'App\Models\Car')
            ->findOrFail($reviewId);

        $review->delete();

        return response()->json(['message' => 'Review deleted successfully.'], 200);
    }

    /**
     * @OA\Delete(
     *     path="/Delete/reviews/flights/{reviewId}",
     *     summary="Delete a review",
     *     tags={"Reviews"},
     *     @OA\Parameter(
     *         name="reviewId",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *         description="ID of the review"
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Review deleted successfully"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Review not found"
     *     )
     * )
     */
    public function deleteFlightReview($reviewId)
    {
        $review = Review::where('reviewable_type', 'App\Models\Flight')
            ->findOrFail($reviewId);

        $review->delete();

        return response()->json(['message' => 'Review deleted successfully.'], 200);
    }

    /**
     * @OA\Delete(
     *     path="/Delete/reviews/hotels/{reviewId}",
     *     summary="Delete a review",
     *     tags={"Reviews"},
     *     @OA\Parameter(
     *         name="reviewId",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *         description="ID of the review"
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Review deleted successfully"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Review not found"
     *     )
     * )
     */
    public function deleteHotelReview($reviewId)
    {
        $review = Review::where('reviewable_type', 'App\Models\Hotel')
            ->findOrFail($reviewId);

        $review->delete();

        return response()->json(['message' => 'Review deleted successfully.'], 200);
    }

    /**
     * @OA\Get(
     *     path="/reviews/cars/{carId}/AvgAndCount",
     *     summary="Get review count and average rating for a specific car",
     *     tags={"Reviews"},
     *     @OA\Parameter(
     *         name="carId",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *         description="ID of the car"
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Review count and average rating for the car",
     *         @OA\JsonContent(
     *             @OA\Property(property="car_id", type="integer"),
     *             @OA\Property(property="number_of_reviews", type="integer"),
     *             @OA\Property(property="average_rating", type="number")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Car not found"
     *     )
     * )
     */

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
    /**
     * @OA\Get(
     *     path="/reviews/flights/{flightId}/AvgAndCount",
     *     summary="Get review count and average rating for a specific flight",
     *     tags={"Reviews"},
     *     @OA\Parameter(
     *         name="flightId",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *         description="ID of the flight"
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Review count and average rating for the flight",
     *         @OA\JsonContent(
     *             @OA\Property(property="flight_id", type="integer"),
     *             @OA\Property(property="number_of_reviews", type="integer"),
     *             @OA\Property(property="average_rating", type="number")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Flight not found"
     *     )
     * )
     */

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
    /**
     * @OA\Get(
     *     path="/reviews/hotels/{hotelId}/AvgAndCount",
     *     summary="Get review count and average rating for a specific hotel",
     *     tags={"Reviews"},
     *     @OA\Parameter(
     *         name="hotelId",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *         description="ID of the hotel"
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Review count and average rating for the hotel",
     *         @OA\JsonContent(
     *             @OA\Property(property="hotel_id", type="integer"),
     *             @OA\Property(property="number_of_reviews", type="integer"),
     *             @OA\Property(property="average_rating", type="number")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Hotel not found"
     *     )
     * )
     */

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
    /**
     * @OA\Get(
     *     path="/cars/{carId}/reviews",
     *     summary="Get all reviews for a car",
     *     tags={"Reviews"},
     *     @OA\Parameter(
     *         name="carId",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *         description="ID of the car"
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="List of reviews",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 @OA\Property(property="id", type="integer"),
     *                 @OA\Property(property="comment", type="string"),
     *                 @OA\Property(property="rating", type="integer"),
     *                 @OA\Property(property="reviewable_type", type="string"),
     *                 @OA\Property(property="reviewable_id", type="integer")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Car not found"
     *     )
     * )
     */
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
    /**
     * @OA\Get(
     *     path="/hotels/{hotelId}/reviews",
     *     summary="Get all reviews for a hotel",
     *     tags={"Reviews"},
     *     @OA\Parameter(
     *         name="hotelId",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *         description="ID of the hotel"
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="List of reviews",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 @OA\Property(property="id", type="integer"),
     *                 @OA\Property(property="comment", type="string"),
     *                 @OA\Property(property="rating", type="integer"),
     *                 @OA\Property(property="reviewable_type", type="string"),
     *                 @OA\Property(property="reviewable_id", type="integer")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Hotel not found"
     *     )
     * )
     */

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

    /**
     * @OA\Get(
     *     path="/flights/{flightId}/reviews",
     *     summary="Get all reviews for a flight",
     *     tags={"Reviews"},
     *     @OA\Parameter(
     *         name="flightId",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *         description="ID of the flight"
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="List of reviews",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 @OA\Property(property="id", type="integer"),
     *                 @OA\Property(property="comment", type="string"),
     *                 @OA\Property(property="rating", type="integer"),
     *                 @OA\Property(property="reviewable_type", type="string"),
     *                 @OA\Property(property="reviewable_id", type="integer")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Flight not found"
     *     )
     * )
     */
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


    /**
     * @OA\Get(
     *     path="/reviews/cars/stats",
     *     summary="Get review statistics for all cars",
     *     tags={"Reviews"},
     *     @OA\Response(
     *         response=200,
     *         description="Statistics for all cars",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 @OA\Property(property="car", type="object",
     *                     @OA\Property(property="id", type="integer"),
     *                     @OA\Property(property="brand", type="string"),
     *                     @OA\Property(property="man_date", type="string"),
     *                     @OA\Property(property="price_per_hour", type="number"),
     *                     @OA\Property(property="colour", type="string"),
     *                     @OA\Property(property="picture_url", type="string"),
     *                     @OA\Property(property="type", type="string")
     *                 ),
     *                 @OA\Property(property="number_of_reviews", type="integer"),
     *                 @OA\Property(property="average_rating", type="number")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="No cars found"
     *     )
     * )
     */

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
    /**
     * @OA\Get(
     *     path="/reviews/flight/stats",
     *     summary="Get review statistics for all flights",
     *     tags={"Reviews"},
     *     @OA\Response(
     *         response=200,
     *         description="Statistics for all flights",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 @OA\Property(property="flight", type="object",
     *                     @OA\Property(property="id", type="integer"),
     *                     @OA\Property(property="flight_number", type="string"),
     *                     @OA\Property(property="departure_date", type="string"),
     *                     @OA\Property(property="arrival_date", type="string"),
     *                     @OA\Property(property="price", type="number"),
     *                     @OA\Property(property="airline", type="string")
     *                 ),
     *                 @OA\Property(property="number_of_reviews", type="integer"),
     *                 @OA\Property(property="average_rating", type="number")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="No flights found"
     *     )
     * )
     */

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

    /**
     * @OA\Get(
     *     path="/reviews/hotel/stats",
     *     summary="Get review statistics for all hotels",
     *     tags={"Reviews"},
     *     @OA\Response(
     *         response=200,
     *         description="Statistics for all hotels",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 @OA\Property(property="hotel", type="object",
     *                     @OA\Property(property="id", type="integer"),
     *                     @OA\Property(property="name", type="string"),
     *                     @OA\Property(property="location", type="string"),
     *                     @OA\Property(property="price_per_night", type="number"),
     *                     @OA\Property(property="rating", type="number"),
     *                     @OA\Property(property="picture_url", type="string")
     *                 ),
     *                 @OA\Property(property="number_of_reviews", type="integer"),
     *                 @OA\Property(property="average_rating", type="number")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="No hotels found"
     *     )
     * )
     */

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



