<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Carbon\Carbon;

class CourseSeeder extends Seeder
{
    public function run()
    {
        // List of categories
        $categories = [
            'Frontend Developer', 
            'Backend Developer', 
            'Wordpress Developer',
            'Graphics Designer',
            'Fullstack Developer',
            'UI/UX Designer'
        ];

        // Use Faker to generate data
        $faker = Faker::create();
        $timestamp = Carbon::now();
        // Determine how many courses you want to seed, for example 10
        $numCourses = 1; // You can adjust this number or make it dynamic

        // Loop to create the desired number of courses
        for ($i = 0; $i < $numCourses; $i++) {
            DB::table('tbl_courses')->insert([
                'category' => $categories[array_rand($categories)], // Random category from the list
                'name' => $faker->sentence(7), // Random course name
                'slug' => $faker->slug(), // Random slug
                'type' => $faker->randomElement(['free', 'premium']), // Random type
                'status' => $faker->randomElement(['published']), // Random status
                'price' => $faker->randomFloat(2, 0, 200),
                // 'price' => 0,
                'level' => $faker->randomElement(['beginner', 'intermediate', 'expert']), // Random level
                'description' => $faker->paragraph(), // Random description
                'resources' => $faker->url(), // Random resource URL
                'link_grub' => $faker->url(), // Random link
                'mentor_id' => 1, // Random mentor ID, assuming mentors 1-5 exist
                'created_at' => $timestamp,
                'updated_at' => $timestamp
            ]);
        }
    }
}
