<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Course;

class LandingpageController extends Controller
{
    public function index()
    {
        // Mengambil data kursus yang memiliki status 'published'
        // Data kursus juga dimuat dengan relasi 'users
        // Data kursus dipilih secara acak menggunakan inRandomOrder() dan dibatasi sebanyak 8 kursus
        $courses = Course::with('users')->where('status', 'published')
            ->inRandomOrder() // Pilih secara acak
            ->take(8)          // Batasi hasilnya menjadi 8 kursus
            ->get();
        // Mengambil semua ID kursus yang termasuk dalam bundle


        // Mengirimkan data kursus dan ID bundle ke view 'member.home'
        return view('member.home', compact('courses'));
    }
}
