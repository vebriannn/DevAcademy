<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;


class LandingpageController extends Controller
{
    public function index(){
        $courses = Course::where('status', 'published')
                         ->orderBy('id', 'DESC')
                         ->take(8)
                         ->get();
    
        return view('member.home', compact('courses'));
    }
    public function tes(){
        return view('member.detail-play');
    }
}
