<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HotelsBookingsTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('hotels_bookings')->insert([
            'user_id' => 2,
            'hotel_id' => 1,
            'review_id' => 2,
            'start_date' => '2024-09-05',
            'end_date' => '2024-09-07',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('hotels_bookings')->insert([
            'user_id' => 1,
            'hotel_id' => 1,
            'review_id' => 5,
            'start_date' => '2024-09-10',
            'end_date' => '2024-09-12',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
