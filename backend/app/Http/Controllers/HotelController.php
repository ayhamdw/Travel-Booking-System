<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hotel;
use App\Models\HotelsBooking;
class HotelController extends Controller
{

    /**
     * @OA\Get(
     *     path="/api/hotels",
     *     tags={"Hotels"},
     *     summary="Get hotels list",
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
    public function listHotels(Request $request)
    {
        $hotels = Hotel::all(); // all hotels from the database
        return response()->json($hotels);
    }
    // Store a new hotel
    /**
     * @OA\Post(
     *     path="/api/hotels",
     *     summary="Add a new hotel",
     *     tags={"Hotels"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name", "description", "rating", "address", "thumbnail_url", "number_of_rooms_available", "price_per_night"},
     *             @OA\Property(property="name", type="string", example="Grand Plaza"),
     *             @OA\Property(property="description", type="string", example="Luxury hotel in the heart of the city."),
     *             @OA\Property(property="rating", type="integer", example=5),
     *             @OA\Property(property="address", type="string", example="123 Main St, Anytown, USA"),
     *             @OA\Property(property="thumbnail_url", type="string", format="url", example="http://example.com/thumbnail.jpg"),
     *             @OA\Property(property="number_of_rooms_available", type="integer", example=20),
     *             @OA\Property(property="price_per_night", type="number", format="float", example=199.99)
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Hotel added successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="id", type="integer"),
     *             @OA\Property(property="name", type="string"),
     *             @OA\Property(property="description", type="string"),
     *             @OA\Property(property="rating", type="integer"),
     *             @OA\Property(property="address", type="string"),
     *             @OA\Property(property="thumbnail_url", type="string"),
     *             @OA\Property(property="number_of_rooms_available", type="integer"),
     *             @OA\Property(property="price_per_night", type="number", format="float")
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid input"
     *     )
     * )
     */
    public function addHotel(Request $request)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'address' => 'required|string',
            'thumbnail_url' => 'required|url',
            'number_of_rooms_available' => 'required|integer|min:0',
            'price_per_night' => 'required|numeric|min:0',
        ]);

        // Create a new Hotel record
        $hotel = Hotel::create($validated);

        return response()->json($hotel, 201);
    }

    // Update an existing hotel

    /**
     * @OA\Put(
     *     path="/api/hotels/{hotel}",
     *     summary="Update a hotel",
     *     tags={"Hotels"},
     *     @OA\Parameter(
     *         name="hotel",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *         description="ID of the hotel to update"
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name", "description", "rating", "address", "thumbnail_url", "number_of_rooms_available", "price_per_night"},
     *             @OA\Property(property="name", type="string", example="Luxury Hotel"),
     *             @OA\Property(property="description", type="string", example="A five-star hotel with excellent amenities."),
     *             @OA\Property(property="rating", type="integer", example=5),
     *             @OA\Property(property="address", type="string", example="123 Main St, City, Country"),
     *             @OA\Property(property="thumbnail_url", type="string", format="url", example="http://example.com/image.jpg"),
     *             @OA\Property(property="number_of_rooms_available", type="integer", example=20),
     *             @OA\Property(property="price_per_night", type="number", format="float", example=150.00)
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Hotel updated successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="name", type="string", example="Luxury Hotel"),
     *             @OA\Property(property="description", type="string", example="A five-star hotel with excellent amenities."),
     *             @OA\Property(property="rating", type="integer", example=5),
     *             @OA\Property(property="address", type="string", example="123 Main St, City, Country"),
     *             @OA\Property(property="thumbnail_url", type="string", format="url", example="http://example.com/image.jpg"),
     *             @OA\Property(property="number_of_rooms_available", type="integer", example=20),
     *             @OA\Property(property="price_per_night", type="number", format="float", example=150.00)
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Hotel not found"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid input"
     *     )
     * )
     */
    public function updateHotel(Request $request, Hotel $hotel)
    {

        $validated = $request->validate([
            'name' => 'nullable|string',
            'description' => 'nullable|string',
            'rating' => 'nullable|integer|min:1|max:5',
            'address' => 'nullable|string',
            'thumbnail_url' => 'nullable|url',
            'number_of_rooms_available' => 'nullable|integer|min:0',
            'price_per_night' => 'nullable|numeric|min:0',
        ]);

        // Update the hotel with the validated data
        $hotel->update(array_filter($validated)); // array_filter removes null values

        return response()->json($hotel);
    }

    /**
     * @OA\Delete(
     *     path="/api/hotels/{hotelId}",
     *     summary="Delete a hotel",
     *     tags={"Hotels"},
     *     @OA\Parameter(
     *         name="hotelId",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer"),
     *         description="ID of the hotel"
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Hotel deleted successfully"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Hotel not found"
     *     )
     * )
     */
    public function deleteHotel(Hotel $hotel)
    {
        $hotel->delete();
        return response()->json(['message' => 'Hotel deleted successfully.'], 200);
    }

}
