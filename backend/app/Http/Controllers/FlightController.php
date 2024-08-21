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
    public function addFlight(Request $request)
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

    public function searchAll () {
        $flights = Flight::all();
        return $flights;
    }

    public function search ($from, $to, $departure) {
        $flights = DB::table("flights")
            ->where('departure' , $from)
            ->where('dest' , $to)
            ->where('departure_date' , $departure)
            ->get();
        return $flights;
    }
}
