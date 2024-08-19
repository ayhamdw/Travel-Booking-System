<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class HotelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fake = Faker::create();
        for ($i = 0; $i < 10; $i++) {
            DB::table('hotels')->insert([
                'name' => $fake->company(),
                'rating' => $fake->numberBetween(1, 5),
                'address' => $fake->address(),
                'thumbnail_url' => $fake->imageUrl(),
                'description' => $fake->text(),
                'number_of_rooms_available' => $fake->numberBetween(1, 30),
                'price_per_night' => $fake->numberBetween(100, 1000),
            ]);
        }

    }
}
