<?php

namespace App\Http\Controllers\member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;

use App\Models\Category;
use App\Models\Course;
use App\Models\Chapter;
use App\Models\User;


class MemberCourseController extends Controller
{
    public function index(){
        $category = Category::orderBy('id', 'DESC')->get();
        
        $addData = [
            'id' => 0,
            'name' => 'All' 
        ];
        
        $newCategory = $category->push((object)$addData);
        $sortedCategory = $newCategory->sortBy('id');

        return view('member.usercourse', compact('sortedCategory'));
    }

    public function join($id){
        $chapters = Chapter::where('course_id', $id)->get();
        $course = Course::findOrFail($id);
        return view('member.gabungkelas', compact('chapters', 'course', 'id'));
    }


    public function play(){
        return view('member.classvideo');
    }
}