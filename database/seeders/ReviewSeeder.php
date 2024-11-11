<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $reviews = [];

        // Generate 20 reviews, with user_id and course_id set to 1
        for ($i = 0; $i < 10; $i++) {
            $reviews[] = [
                'user_id' => 1, // Fixed user ID
                'course_id' => 1, // Fixed course ID
                'note' => $faker->sentence(10), // Random sentence for review note
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('tbl_reviews')->insert($reviews);
    }
}
