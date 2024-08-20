<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HotelsTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('hotels')->insert([
            'name' => 'Ritz-Carlton',
            'description' => 'Luxury 5-star hotel',
            'rating' => 5,
            'address' => 'Jeddah, Saudi Arabia',
            'thumbnail_url' => '/images/ritz.jpg',
            'number_of_rooms_available' => 20,
            'price_per_night' => 300.00,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('hotels')->insert([
            'name' => 'Hilton',
            'description' => '4-star hotel with ocean view',
            'rating' => 4,
            'address' => 'Dubai, UAE',
            'thumbnail_url' => '/images/hilton.jpg',
            'number_of_rooms_available' => 50,
            'price_per_night' => 200.00,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
