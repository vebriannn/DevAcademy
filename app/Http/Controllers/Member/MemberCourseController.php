<?php

namespace App\Http\Controllers\member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Env;

use App\Models\Ebook;
use App\Models\Category;
use App\Models\Course;
use App\Models\Chapter;
use App\Models\Lesson;
use App\Models\User;
use App\Models\Comments;
use App\Models\Transaction;
use App\Models\CourseTools;
use App\Models\Review;

class MemberCourseController extends Controller
{
    public function index(Request $request)
    {
        $searchQuery = $request->input('search-input');
        $categoryFilter = $request->input('filter-kelas');
        $paketFilter = $request->input('filter-paket');
        $coursesQuery = Course::where('status', 'published');
        $ebooksQuery = Ebook::where('status', 'published');
        
        if ($searchQuery) {
            $coursesQuery->where('name', 'LIKE', '%' . $searchQuery . '%');
            $ebooksQuery->where('name', 'LIKE', '%' . $searchQuery . '%');
        }
    
        if ($categoryFilter && $categoryFilter != 'semua') {
            $coursesQuery->where('category', $categoryFilter);
            $ebooksQuery->where('category', $categoryFilter);
        }
        switch ($paketFilter) {
            case 'paket-video':
                $coursesQuery->whereDoesntHave('ebook');
                break;
            
            case 'paket-ebook':
                $ebooksQuery->whereNull('course_id');
                break;
    
            case 'paket-bundling':
                $coursesQuery->whereHas('ebook');
                break;
            case 'semua':
            default:
                break;
        }
    
        // Ambil hasil query
        $courses = $coursesQuery->orderBy('id', 'DESC')->get();
        $ebooks = $ebooksQuery->orderBy('id', 'DESC')->get();
        $categories = Category::orderBy('id', 'DESC')->get();
    
        return view('member.course', compact('courses', 'categories', 'ebooks','paketFilter'));
    }
    

    public function join($slug)
    {
        $courses = Course::where('slug', $slug)->first();
    
        if ($courses) {
            $chapters = Chapter::with('lessons')->where('course_id', $courses->id)->get();
            $reviews = Review::where('course_id', $courses->id)->get();
    
            $lesson = $chapters->isNotEmpty() 
                ? Lesson::with('chapters')->where('chapter_id', $chapters->first()->id)->first() 
                : null;
    
            if (Auth::user()) {
                $transaction = Transaction::where('user_id', Auth::user()->id)
                    ->where('course_id', $courses->id)
                    ->orderBy('created_at', 'desc')
                    ->first();
            } else {
                $transaction = null;
            }
    
            $transactionForEbook = null;
            return view('member.joincourse', compact('chapters', 'course', 'lesson', 'transaction', 'transactionForEbook', 'coursetools'));
        } else {
            return redirect('pages.error');
        }
    
        $coursetools = Course::with('tools')->findOrFail($courses->id);
    
        return view('member.joincourse', compact('reviews', 'chapters', 'courses', 'lesson', 'transaction', 'transactionForEbook', 'coursetools'));
    }
    

    public function play($slug, $episode)
    {
        $courses = Course::where('slug', $slug)->first();
        $user = User::where('id', $courses->mentor_id)->first();
        $chapters = Chapter::with('lessons')->where('course_id', $courses->id)->get();
        $play = Lesson::where('episode', $episode)->first();
        $checkTrx = Transaction::where('course_id', $courses->id)->where('user_id', Auth::user()->id)->first();

        $checkReview = Review::where('user_id', Auth::user()->id)->first();

        if($checkTrx) {
            return view('member.play', compact('play', 'chapters', 'slug', 'courses', 'user', 'checkReview'));
        }
        else {
            Alert::error('error', 'Maaf Akses Tidak Bisa, Karena Anda belum Beli Kelas!!!');
            return redirect()->route('member.course.join', $slug);
        }
    }

    public function detail($slug){
        $courses = Course::where('slug', $slug)->first();
        $user = User::where('id', $courses->mentor_id)->first();
        $chapters = Chapter::with('lessons')->where('course_id', $courses->id)->get();
        $checkTrx = Transaction::where('course_id', $courses->id)->where('user_id', Auth::user()->id)->first();
        $checkReview = Review::where('user_id', Auth::user()->id)->first();
        $coursetools = Course::with('tools')->findOrFail($courses->id);

        if($checkTrx) {
            return view('member.detail-play', compact('chapters', 'slug', 'courses', 'user', 'checkReview','coursetools'));
        }
        else {
            Alert::error('error', 'Maaf Akses Tidak Bisa, Karena Anda belum Beli Kelas!!!');
            return redirect()->route('member.course.join', $slug);
        }
    }
}
