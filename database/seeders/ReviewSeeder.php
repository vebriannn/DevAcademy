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
        $faker = Faker::create('id_ID'); 
        $reviews = [];
        $userIds = [1, 2, 3, 4];
        $courseIds = [1, 2, 3]; 

        foreach (range(1, 4) as $index) { 
            $reviews[] = [
                'user_id' => $faker->randomElement($userIds),
                'course_id' => $faker->randomElement($courseIds),
                'rating' => $faker->numberBetween(1, 5),
                'note' => $faker->paragraph, 
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('tbl_reviews')->insert($reviews);
    }
}
