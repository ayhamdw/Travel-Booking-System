<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\CarBooking;
use Illuminate\Support\Facades\DB;

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
        $cars = Car::all(); // all cars from the database
        return response()->json($cars);
    }

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
        $validated = $request->validate([
            'brand' => 'required|string',
            'man_date' => 'required|integer|digits:4',
            'price_per_hour' => 'required|numeric|min:0',
            'colour' => 'required|string',
            'picture_url' => 'required|url',
            'type' => 'required|string',
        ]);

        $car = Car::create($validated);

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
        $validated = $request->validate([
            'brand' => 'nullable|string',
            'man_date' => 'nullable|integer|digits:4',
            'price_per_hour' => 'nullable|numeric|min:0',
            'colour' => 'nullable|string',
            'picture_url' => 'nullable|url',
            'type' => 'nullable|string',
        ]);

        $car->update(array_filter($validated));

        return response()->json($car);
    }

    /**
     * @OA\Delete(
     *     path="/api/cars/{car}",
     *     summary="Delete a car",
     *     tags={"Cars"},
     *     @OA\Parameter(
     *         name="car",
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
        $car->delete();

        return response()->json(['message' => 'Car deleted successfully.'], 200);
    }

    /**
     * @OA\Get(
     *     path="/search/specific",
     *     tags={"Cars"},
     *     summary="Search for specific cars",
     *     @OA\Parameter(
     *         name="brand",
     *         in="query",
     *         required=false,
     *         @OA\Schema(type="string"),
     *         description="Car brand"
     *     ),
     *     @OA\Parameter(
     *         name="man_date",
     *         in="query",
     *         required=false,
     *         @OA\Schema(type="integer"),
     *         description="Manufacture date"
     *     ),
     *     @OA\Parameter(
     *         name="type",
     *         in="query",
     *         required=false,
     *         @OA\Schema(type="string"),
     *         description="Car type"
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="List of cars matching the search criteria"
     *     )
     * )
     */
    public function specificCar(Request $request)
    {
        $brand = $request->query('brand');
        $man_date = $request->query('man_date');
        $type = $request->query('type');

        $query = Car::query();

        if ($brand) {
            $query->where('brand', $brand);
        }

        if ($man_date) {
            $query->where('man_date', $man_date);
        }

        if ($type) {
            $query->where('type', $type);
        }

        $cars = $query->get();
        return response()->json($cars);
    }

    /**
     * @OA\Get(
     *     path="/search/booking",
     *     tags={"Bookings"},
     *     summary="Get car bookings",
     *     @OA\Parameter(
     *         name="user_id",
     *         in="query",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *         description="User ID"
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="List of car bookings for the specified user"
     *     )
     * )
     */
    public function getCarBookings(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|integer',
        ]);

        $carBookings = DB::table('car_bookings')
            ->join('cars', 'cars.id', '=', 'car_bookings.car_id')
            ->join('users', 'users.id', '=', 'car_bookings.user_id')
            ->where('car_bookings.user_id', $validated['user_id'])
            ->select('cars.*')
            ->get();

        return response()->json($carBookings);
    }

    /**
     * @OA\Get(
     *     path="/search/review/{car_id}",
     *     tags={"Reviews"},
     *     summary="Get reviews for a specific car",
     *     @OA\Parameter(
     *         name="car_id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *         description="Car ID"
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="List of reviews for the specified car"
     *     )
     * )
     */
    public function getCarReviews($car_id)
    {
        $reviews = DB::table('reviews')
            ->where('reviewable_type', 'App\Models\Car')
            ->where('reviewable_id', $car_id)
            ->get();

        return response()->json($reviews);
    }
}
