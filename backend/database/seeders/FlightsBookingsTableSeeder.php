<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FlightsBookingsTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('flights_bookings')->insert([
            'user_id' => 2,
            'flight_id' => 1,
            'review_id' => 3,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('flights_bookings')->insert([
            'user_id' => 1,
            'flight_id' => 1,
            'review_id' => 6,
            'created_at' => now(),
            'updated_at' => now(),
        ]);


    }
}
