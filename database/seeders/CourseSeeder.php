<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseSeeder extends Seeder
{
    public function run()
    {
        // Ensure mentor_id exists in users table
        $courses = [
            [
                'category' => 'Fullstack ',
                'name' => 'Introduction to Programming',
                'cover' => 'cover_image_1.jpg',
                'type' => 'free',
                'status' => 'published',
                'price' => 0,
                'level' => 'beginner',
                'description' => 'A basic course on programming concepts.',
                'resources' => 'https://gedangsuket.id',
                'mentor_id' => 1
            ],
            [
                'category' => 'Frontend ',
                'name' => 'Advanced Laravel',
                'cover' => 'cover_image_2.jpg',
                'type' => 'premium',
                'status' => 'draft',
                'price' => 100,
                'level' => 'intermediate',
                'description' => 'An advanced course on Laravel framework.',
                'resources' => 'https://gedangsuket.id',
                'mentor_id' => 1
            ],

            [
                'category' => 'Backend',
                'name' => 'Advanced Linux',
                'cover' => 'cover_image_3.jpg',
                'type' => 'premium',
                'status' => 'draft',
                'price' => 100,
                'level' => 'intermediate',
                'description' => 'An advanced course on Laravel framework.',
                'resources' => 'https://gedangsuket.id',
                'mentor_id' => 1
            ],
        ];

        foreach ($courses as $course) {
            DB::table('tbl_courses')->insert($course);
        }
    }
}