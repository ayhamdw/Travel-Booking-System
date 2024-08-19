<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
class FlightSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 10; $i++) {
            DB::table('flights')->insert([
                'departure' => $faker->city,
                'dest' => $faker->city,
                'price' => $faker->numberBetween(500, 3000),
                'seats_left' => $faker->numberBetween(1, 100),
                'description' => $faker->sentence,
                'departure_date' => $faker->dateTimeBetween('+1 week', '+1 month'),
                'airline_name' => $faker->company,
                'picture_url' => $faker->imageUrl(640, 480, 'transport'),
            ]);
        }

    }
}
