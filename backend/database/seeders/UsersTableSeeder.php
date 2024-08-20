<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'username' => 'admin',
            'password' => Hash::make('password123'),
            'email' => 'admin@example.com',
            'first_name' => 'Admin',
            'last_name' => 'User',
            'role' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('users')->insert([
            'username' => 'john_doe',
            'password' => Hash::make('password123'),
            'email' => 'john@example.com',
            'first_name' => 'John',
            'last_name' => 'Doe',
            'role' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
