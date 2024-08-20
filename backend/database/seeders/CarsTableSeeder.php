<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CarsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('cars')->insert([
            'brand' => 'Toyota',
            'man_date' => 2022,
            'price_per_hour' => 50.00,
            'colour' => 'Red',
            'picture_url' => '/images/toyota.jpg',
            'type' => 'Sedan',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('cars')->insert([
            'brand' => 'Honda',
            'man_date' => 2021,
            'price_per_hour' => 45.00,
            'colour' => 'Blue',
            'picture_url' => '/images/honda.jpg',
            'type' => 'SUV',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
