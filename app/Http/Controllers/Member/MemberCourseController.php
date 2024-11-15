<?php

namespace App\Http\Controllers\member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;



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
use App\Models\CourseEbook;
use App\Models\CompleteEpisodeCourse;
use App\Models\MyListCourse;

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
            case 'paket-kursus':
                $coursesQuery->whereDoesntHave('courseEbooks');
                break;

            case 'paket-ebook':
                $ebooksQuery->whereDoesntHave('courseEbooks');
                break;

            case 'paket-bundling':
                $coursesQuery->whereHas('courseEbooks');
                break;

            case 'semua':
                $ebooksQuery->whereDoesntHave('courseEbooks');
                break;

            default:
                $ebooksQuery->whereDoesntHave('courseEbooks');
                break;
        }

        // Execute the main queries
        $courses = $coursesQuery->orderBy('id', 'DESC')->get();
        $ebooks = $ebooksQuery->orderBy('id', 'DESC')->get();
        $categories = Category::orderBy('id', 'DESC')->get();
        $InBundle = CourseEbook::pluck('course_id')->toArray();
        return view('member.course', compact('courses', 'categories', 'ebooks', 'paketFilter','InBundle'));
    }


    public function join($slug)
    {
        $courses = Course::where('slug', $slug)->first();

        if ($courses) {
            $chapters = Chapter::with('lessons')->where('course_id', $courses->id)->get();
            $reviews = Review::with('user')->where('course_id', $courses->id)->get();
            $bundling = CourseEbook::with(['course', 'ebook'])
                ->where('course_id', $courses->id)
                ->first();

            $lesson = $chapters->isNotEmpty()
                ? Lesson::with('chapters')->where('chapter_id', $chapters->first()->id)->first()
                : null;

            $transaction = Auth::check()
                ? Transaction::where('user_id', Auth::id())
                    ->where('course_id', $courses->id)
                    ->orderBy('created_at', 'desc')
                    ->first()
                : null;

            $coursetools = Course::with('tools')->findOrFail($courses->id);
            $transactionForEbook = null;
            $InBundle = CourseEbook::pluck('course_id')->toArray();


            return view('member.joincourse', compact('chapters', 'courses', 'lesson', 'transaction','transactionForEbook', 'coursetools', 'reviews', 'bundling'));
        } else {
            return redirect()->route('pages.error');
        }
    }



    public function play($slug, $episode)
    {
        $courses = Course::where('slug', $slug)->first();
        $user = User::where('id', $courses->mentor_id)->first();
        $chapters = Chapter::with('lessons')->where('course_id', $courses->id)->get();
        $play = Lesson::where('episode', $episode)->first();
        $checkTrx = Transaction::where('course_id', $courses->id)->where('user_id', Auth::user()->id)->first();

        $paketKelas = CourseEbook::where('course_id', $courses->id)->first();

        $checkReview = Review::where('user_id', Auth::user()->id)->first();

        // save compelete video
        $checkCompelete = CompleteEpisodeCourse::where('episode_id', $play->id)
            ->where('course_id', $courses->id)
            ->where('user_id', Auth::user()->id) // Filter by user_id
            ->first();
        if (!$checkCompelete) {
            CompleteEpisodeCourse::create([
                'user_id' => Auth::user()->id,
                'course_id' =>  $courses->id,
                'episode_id' => $play->id
            ]);
        }

        // get all episode complete
        $epComplete = CompleteEpisodeCourse::where('course_id', $courses->id)
            ->where('user_id', Auth::user()->id)
            ->pluck('episode_id')
            ->toArray();


        if ($checkTrx) {
            return view('member.play', compact('play', 'chapters', 'slug', 'courses', 'user', 'checkReview', 'paketKelas', 'epComplete'));
        } else {
            Alert::error('error', 'Maaf Akses Tidak Bisa, Karena Anda belum Beli Kelas!!!');
            return redirect()->route('member.course.join', $slug);
        }
    }


    public function detail($slug)
    {
        $courses = Course::where('slug', $slug)->first();
        $reviews = Review::with('user')->where('course_id', $courses->id)->get();
        $user = User::where('id', $courses->mentor_id)->first();
        $chapters = Chapter::with('lessons')->where('course_id', $courses->id)->get();
        $checkTrx = Transaction::where('course_id', $courses->id)->where('user_id', Auth::user()->id)->first();
        $checkReview = Review::where('user_id', Auth::user()->id)->where('course_id', $courses->id)->first();
        $coursetools = Course::with('tools')->findOrFail($courses->id);
        $compeleteEps = CompleteEpisodeCourse::where('user_id', Auth::user()->id)->where('course_id', $courses->id)->get();

        $totalLesson = 0;
        foreach ($chapters as $chapter) {
            $totalLesson += $chapter->lessons->count();
        }

        $checkSertifikat = false;
        if($totalLesson == $compeleteEps->count()) {
            $checkSertifikat = true;
        }


        if ($checkTrx) {
            return view('member.detail-course', compact('chapters', 'slug', 'courses', 'user', 'checkReview', 'coursetools','reviews', 'checkSertifikat'));
        } else {
            Alert::error('error', 'Maaf Akses Tidak Bisa, Karena Anda belum Beli Kelas!!!');
            return redirect()->route('member.course.join', $slug);
        }
    }


    public function generateSertifikat($slug)
    {
        $course = Course::where('slug', $slug)->first();
        $checkCourse = MyListCourse::where('course_id', $course->id);
        if ($checkCourse) {

            // Data dinamis
            $data = [
                'name' => Auth::user()->name,
                'course' =>  $course->category . ' : ' . $course->name,
                'date' => \Carbon\Carbon::now()->format('d F Y')
            ];

            $pdf = Pdf::loadView('sertifikat.view', $data)->setPaper('A4', 'landscape');

            return $pdf->download('sertifikat-'.Auth::user()->name.'.pdf');
        }
        return redirect()->back();
    }
}
