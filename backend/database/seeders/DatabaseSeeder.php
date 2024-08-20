<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        // Reset AUTO_INCREMENT for all tables

        DB::statement('ALTER TABLE cars AUTO_INCREMENT = 1;');
        DB::statement('ALTER TABLE flights AUTO_INCREMENT = 1;');
        DB::statement('ALTER TABLE hotels AUTO_INCREMENT = 1;');
        DB::statement('ALTER TABLE reviews AUTO_INCREMENT = 1;');
        DB::statement('ALTER TABLE car_bookings AUTO_INCREMENT = 1;');
        DB::statement('ALTER TABLE flights_bookings AUTO_INCREMENT = 1;');
        DB::statement('ALTER TABLE hotels_bookings AUTO_INCREMENT = 1;');

        $this->call([
            UsersTableSeeder::class,
            CarsTableSeeder::class,
            FlightsTableSeeder::class,
            HotelsTableSeeder::class,
            ReviewsTableSeeder::class,
            CarBookingsTableSeeder::class,
            HotelsBookingsTableSeeder::class,
            FlightsBookingsTableSeeder::class,
        ]);
    }
}
