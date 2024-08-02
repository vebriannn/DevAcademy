<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'John Doe',
                'username' => 'johndoe',
                'avatar' => 'avatar1.jpg',
                'email' => 'johndoe@example.com',
                'password' => Hash::make('password123'),
                'role' => 'superadmin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Jane Smith',
                'username' => 'janesmith',
                'avatar' => 'avatar2.jpg',
                'email' => 'janesmith@example.com',
                'password' => Hash::make('password123'),
                'role' => 'mentor',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Student User',
                'username' => 'studentuser',
                'avatar' => 'avatar3.png',
                'email' => 'studentuser@example.com',
                'password' => Hash::make('password123'),
                'role' => 'students',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'Student User 1',
                'username' => 'studentuser',
                'avatar' => 'avatar4.png',
                'email' => 'studentuser1@example.com',
                'password' => Hash::make('password123'),
                'role' => 'students',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'name' => 'Student User 2',
                'username' => 'studentuser',
                'avatar' => 'avatar5.jpg',
                'email' => 'studentuser2@example.com',
                'password' => Hash::make('password123'),
                'role' => 'students',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
