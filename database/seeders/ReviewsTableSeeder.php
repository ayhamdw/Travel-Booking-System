<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReviewsTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('reviews')->insert([
            'comment' => 'Great experience!',
            'rating' => 5,
            'reviewable_type' => 'App\\Models\\Car',
            'reviewable_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('reviews')->insert([
            'comment' => 'Good service',
            'rating' => 4,
            'reviewable_type' => 'App\\Models\\Hotel',
            'reviewable_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('reviews')->insert([
            'comment' => 'Great flight, very smooth and comfortable ',
            'rating' => 4,
            'reviewable_type' => 'App\\Models\\Flight',
            'reviewable_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('reviews')->insert([
            'comment' => 'Nice',
            'rating' => 4,
            'reviewable_type' => 'App\\Models\\Car',
            'reviewable_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('reviews')->insert([
            'comment' => 'Nice Hotel',
            'rating' => 5,
            'reviewable_type' => 'App\\Models\\Hotel',
            'reviewable_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('reviews')->insert([
            'comment' => 'Nice flight ',
            'rating' => 5,
            'reviewable_type' => 'App\\Models\\Flight',
            'reviewable_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

    }
}
