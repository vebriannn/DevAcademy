<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Carbon\Carbon;
use App\Models\Course;

class CourseSeeder extends Seeder
{
    public function run()
    {
        $categories = ['Web Development', 'Graphic Design', 'Data Science', 'Marketing', 'Business'];

        for ($i = 0; $i < 10; $i++) {
            Course::create([
                'mentor_id' => 1, // ganti sesuai mentor_id yang ada di tabel users
                'category' => $categories[array_rand($categories)],
                'name' => 'Course ' . ($i + 1),
                'slug' => 'course-' . ($i + 1),
                'cover' => 'cover-' . ($i + 1),
                'type' => 'premium',
                'status' => 'published',
                'price' => rand(1000, 5000),
                'level' => ['beginner', 'intermediate', 'expert'][array_rand(['beginner', 'intermediate', 'expert'])],
                'sort_description' => 'Ini adalah deskripsi singkat untuk course ' . ($i + 1),
                'long_description' => 'Ini adalah deskripsi panjang yang lebih detail tentang course ' . ($i + 1),
                'link_resources' => 'https://example.com/resource-' . ($i + 1),
                'link_groups' => 'https://example.com/group-' . ($i + 1),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
