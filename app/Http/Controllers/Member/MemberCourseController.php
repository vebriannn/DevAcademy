<?php

namespace App\Http\Controllers\member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;

use App\Models\Category;
use App\Models\Course;
use App\Models\Chapter;
use App\Models\Lesson;
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

    public function join($slug){
        $course = Course::where('slug', $slug)->first();
        $chapters = Chapter::with('lessons')->where('course_id', $course->id)->get();
        $lesson = Lesson::with('chapters')->where('chapter_id', $chapters->first()->id)->first();
        return view('member.gabungkelas', compact('chapters', 'course', 'lesson'));
    }


    public function play($slug, $episode){
        $course = Course::where('slug', $slug)->first();
        $chapters = Chapter::with('lessons')->where('course_id', $course->id)->get();
        $play = Lesson::where('episode', $episode)->first();
        return view('member.classvideo', compact('play', 'chapters', 'slug', 'course'));
    }
}