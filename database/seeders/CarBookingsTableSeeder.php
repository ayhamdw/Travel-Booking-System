<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CarBookingsTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('car_bookings')->insert([
            'user_id' => 2,
            'car_id' => 1,
            'review_id' => 1,
            'start_date' => '2024-09-01',
            'end_date' => '2024-09-03',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('car_bookings')->insert([
            'user_id' => 1,
            'car_id' => 1,
            'review_id' => 4,
            'start_date' => '2024-09-10',
            'end_date' => '2024-09-12',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
