<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Course;
use App\Models\Ca

class MemberCourseController extends Controller
{
    public function index() {
        $course = Course::all();
        
        return view('index', compact('course'));
    } 

    public function course() {

        
        return view('usercourse');
    } 

    public function join() {
        return view('gabungkelas');
    }

    public function play() {
        return view('classvideo');
    }
    
    public function payment() {
        return view('payment');
    }
}