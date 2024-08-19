<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fake = Faker::create();
        for ($i = 1; $i <= 10; $i++) {
            DB::table('cars')->insert([
                'brand' => $fake->company(),
                'man_date' => $fake->date('Y'),
                'price_per_hour' => $fake->numberBetween(10, 100),
                'colour' => $fake->colorName(),
                'picture_url' => $fake->imageUrl(),
                'type' => $fake->word(),
            ]);
        }

    }
}
