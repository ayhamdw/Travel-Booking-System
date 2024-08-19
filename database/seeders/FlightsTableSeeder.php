<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FlightsTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('flights')->insert([
            'departure' => 'Jeddah',
            'dest' => 'Dubai',
            'price' => 150.00,
            'seats_left' => 30,
            'description' => 'Direct flight from Jeddah to Dubai',
            'departure_date' => '2024-09-01',
            'airline_name' => 'Saudia Airlines',
            'picture_url' => '/images/saudia.jpg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('flights')->insert([
            'departure' => 'Riyadh',
            'dest' => 'Cairo',
            'price' => 120.00,
            'seats_left' => 40,
            'description' => 'Direct flight from Riyadh to Cairo',
            'departure_date' => '2024-09-15',
            'airline_name' => 'EgyptAir',
            'picture_url' => '/images/egyptair.jpg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
