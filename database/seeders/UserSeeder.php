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
        $emails = ['admintamvan@example.com','admincantik@example.com'];

        foreach (range(1, 2) as $index) {
            DB::table('users')->insert([
                'name' => $faker->name,
                'username' => $faker->unique()->userName,
                'avatar' => "public/images/avatars/default.png",
                'email' => $emails[array_rand($emails)],
                'password' => Hash::make('password123'), 
                'role' => $roles[array_rand($roles)], 
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
