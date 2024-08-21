<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\CarBooking;
class CarController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/cars",
     *     tags={"Cars"},
     *     summary="Get cars list",
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
    public function listCars(Request $request): \Illuminate\Http\JsonResponse
    {
        $cars = Car::all(); // all hotels from the database
        return response()->json($cars);
    }

    // Store a new car
    /**
     * @OA\Post(
     *     path="/api/cars",
     *     summary="Add a new car",
     *     tags={"Cars"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"brand", "man_date", "price_per_hour", "colour", "picture_url", "type"},
     *             @OA\Property(property="brand", type="string", example="Toyota"),
     *             @OA\Property(property="man_date", type="integer", example=2020),
     *             @OA\Property(property="price_per_hour", type="number", format="float", example=15.50),
     *             @OA\Property(property="colour", type="string", example="Red"),
     *             @OA\Property(property="picture_url", type="string", format="url", example="https://example.com/car.jpg"),
     *             @OA\Property(property="type", type="string", example="SUV")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Car added successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Car added successfully"),
     *             @OA\Property(property="car", type="object",
     *                 @OA\Property(property="id", type="integer"),
     *                 @OA\Property(property="brand", type="string"),
     *                 @OA\Property(property="man_date", type="integer"),
     *                 @OA\Property(property="price_per_hour", type="number", format="float"),
     *                 @OA\Property(property="colour", type="string"),
     *                 @OA\Property(property="picture_url", type="string", format="url"),
     *                 @OA\Property(property="type", type="string")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid input"
     *     )
     * )
     */
    public function addCar(Request $request)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'brand' => 'required|string',
            'man_date' => 'required|integer|digits:4',
            'price_per_hour' => 'required|numeric|min:0',
            'colour' => 'required|string',
            'picture_url' => 'required|url',
            'type' => 'required|string',
        ]);

        // Create a new car record
        $car = Car::create($validated);

        // Return a JSON response
        return response()->json(['message' => 'Car added successfully', 'car' => $car], 201);
    }

    /**
     * @OA\Put(
     *     path="/api/cars/{car}",
     *     summary="Update a car",
     *     tags={"Cars"},
     *     @OA\Parameter(
     *         name="car",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *         description="ID of the car to update"
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"brand", "man_date", "price_per_hour", "colour", "picture_url", "type"},
     *             @OA\Property(property="brand", type="string", example="Toyota"),
     *             @OA\Property(property="man_date", type="integer", example=2022),
     *             @OA\Property(property="price_per_hour", type="number", format="float", example=15.50),
     *             @OA\Property(property="colour", type="string", example="Red"),
     *             @OA\Property(property="picture_url", type="string", format="url", example="https://example.com/car.jpg"),
     *             @OA\Property(property="type", type="string", example="SUV")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Car updated successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="brand", type="string", example="Toyota"),
     *             @OA\Property(property="man_date", type="integer", example=2022),
     *             @OA\Property(property="price_per_hour", type="number", format="float", example=15.50),
     *             @OA\Property(property="colour", type="string", example="Red"),
     *             @OA\Property(property="picture_url", type="string", format="url", example="https://example.com/car.jpg"),
     *             @OA\Property(property="type", type="string", example="SUV")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Car not found"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid input"
     *     )
     * )
     */
    public function updateCar(Request $request, Car $car)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'brand' => 'nullable|string',
            'man_date' => 'nullable|integer|digits:4',
            'price_per_hour' => 'nullable|numeric|min:0',
            'colour' => 'nullable|string',
            'picture_url' => 'nullable|url',
            'type' => 'nullable|string',
        ]);

        // Update the car with the validated data
        $car->update(array_filter($validated)); // array_filter removes null values

        // Return a JSON response with the updated car
        return response()->json($car);
    }

    /**
     * @OA\Delete(
     *     path="/api/cars/{carId}",
     *     summary="Delete a car",
     *     tags={"Cars"},
     *     @OA\Parameter(
     *         name="carId",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *         description="ID of the car"
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Car deleted successfully"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Car not found"
     *     )
     * )
     */
    public function deleteCar(Car $car)
    {
        // Delete the car
        $car->delete();

        // Return a JSON response confirming deletion
        return response()->json(['message' => 'Car deleted successfully.'], 200);
    }

}
