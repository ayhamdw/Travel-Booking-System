<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FlightController extends Controller
{


    /**
     * @OA\Get(
     *     path="/api/flights",
     *     tags={"Flights"},
     *     summary="Get flights list",
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
    public function listFlights(Request $request)
    {
        $flights = Flight::all(); // all hotels from the database
        return response()->json($flights);
    }

    // add a new flight
    /**
     * @OA\Post(
     *     path="/api/flights",
     *     summary="Add a new flight",
     *     tags={"Flights"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"departure", "dest", "price", "seats_left", "description", "departure_date", "airline_name"},
     *             @OA\Property(property="departure", type="string", example="New York"),
     *             @OA\Property(property="dest", type="string", example="Los Angeles"),
     *             @OA\Property(property="price", type="number", format="float", example=299.99),
     *             @OA\Property(property="seats_left", type="integer", example=50),
     *             @OA\Property(property="description", type="string", example="Direct flight from New York to Los Angeles."),
     *             @OA\Property(property="departure_date", type="string", format="date", example="2024-12-01"),
     *             @OA\Property(property="airline_name", type="string", example="Skyline Airlines")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Flight added successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="id", type="integer"),
     *             @OA\Property(property="departure", type="string"),
     *             @OA\Property(property="dest", type="string"),
     *             @OA\Property(property="price", type="number", format="float"),
     *             @OA\Property(property="seats_left", type="integer"),
     *             @OA\Property(property="description", type="string"),
     *             @OA\Property(property="departure_date", type="string", format="date"),
     *             @OA\Property(property="airline_name", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid input"
     *     )
     * )
     */
    public function addFlight(Request $request): \Illuminate\Http\JsonResponse
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'departure' => 'required|string',
            'dest' => 'required|string',
            'price' => 'required|numeric|min:0',
            'seats_left' => 'required|integer|min:0',
            'description' => 'required|string',
            'departure_date' => 'required|date',
            'airline_name' => 'required|string',
            'picture_url' => 'nullable|url',
        ]);

        // Create a new Flight record
        $flight = Flight::create($validated);
        // Return a JSON response with the created flight and a 201 status code
        return response()->json($flight, 201);
    }

    // Update an existing flight

    /**
     * @OA\Put(
     *     path="/api/flights/{flight}",
     *     summary="Update a flight",
     *     tags={"Flights"},
     *     @OA\Parameter(
     *         name="flight",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *         description="ID of the flight to update"
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"departure", "dest", "price", "seats_left", "description", "departure_date", "airline_name"},
     *             @OA\Property(property="departure", type="string", example="New York"),
     *             @OA\Property(property="dest", type="string", example="Los Angeles"),
     *             @OA\Property(property="price", type="number", format="float", example=350.75),
     *             @OA\Property(property="seats_left", type="integer", example=120),
     *             @OA\Property(property="description", type="string", example="Direct flight from NYC to LA."),
     *             @OA\Property(property="departure_date", type="string", format="date", example="2024-12-01"),
     *             @OA\Property(property="airline_name", type="string", example="Delta Airlines")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Flight updated successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="departure", type="string", example="New York"),
     *             @OA\Property(property="dest", type="string", example="Los Angeles"),
     *             @OA\Property(property="price", type="number", format="float", example=350.75),
     *             @OA\Property(property="seats_left", type="integer", example=120),
     *             @OA\Property(property="description", type="string", example="Direct flight from NYC to LA."),
     *             @OA\Property(property="departure_date", type="string", format="date", example="2024-12-01"),
     *             @OA\Property(property="airline_name", type="string", example="Delta Airlines")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Flight not found"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid input"
     *     )
     * )
     */
    public function updateFlight(Request $request, Flight $flight)
    {
        $validated = $request->validate([
            'departure' => 'nullable|string',
            'dest' => 'nullable|string',
            'price' => 'nullable|numeric|min:0',
            'seats_left' => 'nullable|integer|min:0',
            'description' => 'nullable|string',
            'departure_date' => 'nullable|date',
            'airline_name' => 'nullable|string',
        ]);

        // Update the flight with the validated data
        $flight->update(array_filter($validated)); // array_filter removes null values

        return response()->json($flight);
    }

    /**
     * @OA\Delete(
     *     path="/api/flights/{flightId}",
     *     summary="Delete a flight",
     *     tags={"Flights"},
     *     @OA\Parameter(
     *         name="flightId",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *         description="ID of the flight"
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Flight deleted successfully"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Flight not found"
     *     )
     * )
     */
    public function deleteFlight(Flight $flight)
    {
        // Delete the flight
        $flight->delete();

        // Return a JSON response confirming deletion
        return response()->json(['message' => 'Flight deleted successfully.'], 200);
    }

    /**
     * @OA\Get(
     *     path="/api/search/all",
     *     tags={"Flights"},
     *     summary="Get all flights",
     *     security={
     *         {"passport": {}},
     *     },
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 type="object",
     *                 @OA\Property(property="id", type="integer"),
     *                 @OA\Property(property="departure", type="string"),
     *                 @OA\Property(property="dest", type="string"),
     *                 @OA\Property(property="departure_date", type="string", format="date"),
     *                 // Add other properties as needed
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response="default",
     *         description="An unexpected error occurred"
     *     )
     * )
     */
    public function searchAll() {
        $flights = Flight::all();
        return response()->json($flights);
    }

    /**
     * @OA\Get(
     *     path="/api/search/specific",
     *     tags={"Flights"},
     *     summary="Search for specific flights",
     *     @OA\Parameter(
     *         name="departure",
     *         in="query",
     *         required=false,
     *         @OA\Schema(type="string"),
     *         description="Departure location"
     *     ),
     *     @OA\Parameter(
     *         name="dest",
     *         in="query",
     *         required=false,
     *         @OA\Schema(type="string"),
     *         description="Destination location"
     *     ),
     *     @OA\Parameter(
     *         name="departure_date",
     *         in="query",
     *         required=false,
     *         @OA\Schema(type="string", format="date"),
     *         description="Departure date"
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 type="object",
     *                 @OA\Property(property="id", type="integer"),
     *                 @OA\Property(property="departure", type="string"),
     *                 @OA\Property(property="dest", type="string"),
     *                 @OA\Property(property="departure_date", type="string", format="date"),
     *                 // Add other properties as needed
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response="default",
     *         description="An unexpected error occurred"
     *     )
     * )
     */
    public function searchSpecific(Request $request) {
        $from = $request->query('departure');
        $to = $request->query('dest');
        $departure_date = $request->query('departure_date');

        $query = Flight::query();

        if ($from !== null) {
            $query->where('departure', $from);
        }

        if ($to !== null) {
            $query->where('dest', $to);
        }

        if ($departure_date !== null) {
            $query->where('departure_date', $departure_date);
        }

        $flights = $query->get();
        return response()->json($flights);
    }



    /**
     * @OA\Get(
     *     path="/api/search/review/{flight_id}",
     *     tags={"Flights"},
     *     summary="Get reviews for a specific flight",
     *     @OA\Parameter(
     *         name="flight_id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *         description="ID of the flight"
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 type="object",
     *                 @OA\Property(property="comment", type="string"),
     *                 @OA\Property(property="rating", type="integer"),
     *                 @OA\Property(property="updated_at", type="string", format="date-time")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response="default",
     *         description="An unexpected error occurred"
     *     )
     * )
     */
    public function flightReview($flightId) {
        $flightReview = DB::table('flights')
            ->join('reviews', 'reviews.reviewable_id', '=', 'flights.id')
            ->where('reviews.reviewable_type', 'App\Models\Flight')
            ->where('reviews.reviewable_id', $flightId)
            ->select('reviews.comment', 'reviews.rating', 'reviews.updated_at')
            ->get();

        return response()->json($flightReview);
    }

}
