<?php

namespace App\Http\Controllers\member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MemberCourseController extends Controller
{
    public function index(){
        return view('member.Usercourse');
    }

    public function join(){
        return view('member.gabungkelas');
    }

    public function play(){
        return view('member.classvideo');
    }
}
