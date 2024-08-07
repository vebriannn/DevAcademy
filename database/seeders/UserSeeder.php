<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        $faker = Faker::create();
        
        $roles = ['superadmin'];

        // Seed 20 users
        foreach (range(1, 15) as $index) {
            DB::table('users')->insert([
                'name' => $faker->name,
                'username' => $faker->unique()->userName,
                'avatar' => $faker->imageUrl(200, 200, 'people', true, 'avatar'),
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('password123'), 
                'role' => $roles[array_rand($roles)], 
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
