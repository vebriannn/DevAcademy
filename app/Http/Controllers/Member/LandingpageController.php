<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\CourseEbook;


class LandingpageController extends Controller
{
    public function index()
    {
        $courses = Course::where('status', 'published')
            ->inRandomOrder() 
            ->take(8)          
            ->get();
        $InBundle = CourseEbook::pluck('course_id')->toArray();   
        return view('member.home', compact('courses', 'InBundle'));
    }    
    public function tes()
    {
        return view('member.detail-play');
    }
}
