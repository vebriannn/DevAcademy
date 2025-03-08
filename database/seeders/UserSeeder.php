<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        // Seed 20 users
        $users = [
            [
                'name' => 'John Doe',
                'avatar' => 'avatars/johndoe.png',
                'email' => 'john@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'profession' => 'Frontend Developer',
                'role' => 'students'
            ],
            [
                'name' => 'Jane Smith',
                'avatar' => 'avatars/janesmith.png',
                'email' => 'jane@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'profession' => 'UI/UX Designer',
                'role' => 'mentor'
            ],
            [
                'name' => 'Alice Johnson',
                'avatar' => 'avatars/alice.png',
                'email' => 'alice@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'profession' => 'Backend Developer',
                'role' => 'students'
            ],
            [
                'name' => 'Bob Williams',
                'avatar' => 'avatars/bob.png',
                'email' => 'bob@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'profession' => 'Fullstack Developer',
                'role' => 'superadmin'
            ],
            [
                'name' => 'Charlie Brown',
                'avatar' => 'avatars/charlie.png',
                'email' => 'charlie@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'profession' => 'Pelajar Jangka Panjang',
                'role' => 'students'
            ],
            [
                'name' => 'Diana Prince',
                'avatar' => 'avatars/diana.png',
                'email' => 'diana@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'profession' => 'UI/UX Designer',
                'role' => 'mentor'
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
