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
        $perPage = 9; // Jumlah data per halaman
    
        // Query untuk kursus
        $coursesQuery = Course::where('status', 'published');
    
        // Query untuk ebook
        $ebooksQuery = Ebook::where('status', 'published');
    
        // Filter pencarian
        if ($searchQuery) {
            $coursesQuery->where('name', 'LIKE', '%' . $searchQuery . '%');
            $ebooksQuery->where('name', 'LIKE', '%' . $searchQuery . '%');
        }
    
        // Filter kategori
        if ($categoryFilter && $categoryFilter != 'semua') {
            $coursesQuery->where('category', $categoryFilter);
            $ebooksQuery->where('category', $categoryFilter);
        }
    
        // Filter paket
        switch ($paketFilter) {
            case 'paket-kursus':
                $coursesQuery->whereDoesntHave('courseEbooks');
                $ebooksQuery = null; // Jangan ambil data ebook
                break;
    
            case 'paket-ebook':
                $ebooksQuery->whereDoesntHave('courseEbooks');
                $coursesQuery = null; // Jangan ambil data kursus
                break;
    
            case 'paket-bundling':
                $coursesQuery->whereHas('courseEbooks');
                $ebooksQuery = null; // Jangan ambil data ebook
                break;
    
            default:
                $ebooksQuery->whereDoesntHave('courseEbooks');
                break;
        }
    
        $courses = $coursesQuery ? $coursesQuery->with('users','courseEbooks')->select('id','mentor_id','cover', 'name', 'category','slug', 'created_at','product_type','price')->get() : collect();
        $ebooks = $ebooksQuery ? $ebooksQuery->with('users')->select('id','mentor_id','cover', 'name', 'category','slug', 'created_at','product_type','price')->get() : collect();
        $merged = $courses->concat($ebooks)->sortByDesc('created_at');
    
        $page = $request->input('page', 1);
        $paginatedData = new \Illuminate\Pagination\LengthAwarePaginator(
            $merged->forPage($page, $perPage),
            $merged->count(),
            $perPage,
            $page,
            ['path' => $request->url(), 'query' => $request->query()]
        );
    
        $courseIds = $courses->pluck('id')->toArray();
        $bundling = CourseEbook::whereIn('course_id', $courseIds)->get()->groupBy('course_id');
    
        return view('member.course', [
            'data' => $paginatedData,
            'paketFilter' => $paketFilter,
            'bundling' => $bundling, 
        ]);
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
        $checkCompelete = CompleteEpisodeCourse::where('episode_id', $play->id)
            ->where('course_id', $courses->id)
            ->where('user_id', Auth::user()->id)
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
