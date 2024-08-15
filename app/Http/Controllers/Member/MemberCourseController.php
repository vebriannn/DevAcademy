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
use App\Models\Transaction;


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

        return view('member.course', compact('sortedCategory'));
    }

    public function join($slug)
    {
        $course = Course::where('slug', $slug)->first();
        $user = auth()->user();
    
        if ($course) {
            $chapters = Chapter::with('lessons')->where('course_id', $course->id)->get();
    
            if ($chapters->isNotEmpty()) {
                $lesson = Lesson::with('chapters')->where('chapter_id', $chapters->first()->id)->first();
            } else {
                $lesson = null;
            }
    
            // Cek transaksi pengguna untuk kursus ini
            $transaction = Transaction::where('user_id', $user->id)
                ->where('course_id', $course->id)
                ->orderBy('created_at', 'desc')
                ->first();
        } else {
            $chapters = collect();
            $lesson = null;
            $transaction = null;
        }
    
        return view('member.joincourse', compact('chapters', 'course', 'lesson', 'transaction'));
    }
    


    public function play($slug, $episode){
        $course = Course::where('slug', $slug)->first();
        $user = User::where('id', $course->mentor_id)->first();
        $chapters = Chapter::with('lessons')->where('course_id', $course->id)->get();
        $play = Lesson::where('episode', $episode)->first();
        
        return view('member.play', compact('play', 'chapters', 'slug', 'course', 'user'));
    }
}