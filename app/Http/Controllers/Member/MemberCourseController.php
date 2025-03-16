<?php

namespace App\Http\Controllers\member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Pagination\LengthAwarePaginator;



use App\Models\Ebook;
use App\Models\Course;
use App\Models\Chapter;
use App\Models\Lesson;
use App\Models\User;
use App\Models\Transaction;
use App\Models\Review;
use App\Models\CourseEbook;
use App\Models\CompleteEpisodeCourse;
use App\Models\MyListCourse;

class MemberCourseController extends Controller
{
    public function index(Request $request)
    {
        // Mengambil input filter
        // $searchQuery = $request->input('search-input');
        // $categoryFilter = $request->input('filter-kelas');

        // Membuat query dasar untuk mengambil data kursus hanya saat status "published"
        // $coursesQuery = Course::where('status', 'published');

        // jalankan logika ini saat ada input dari pencarian
        // if ($searchQuery) {
        //     $coursesQuery->where(function ($query) use ($searchQuery) {
        //         $query->where('name', 'LIKE', '%' . $searchQuery . '%')
        //             ->orWhere('category', 'LIKE', '%' . $searchQuery . '%')
        //             ->orWhereHas('users', function ($q) use ($searchQuery) {
        //                 // Filter berdasarkan nama mentor
        //                 $q->where('name', 'LIKE', '%' . $searchQuery . '%');
        //             });
        //     });
        // }

        // Jalankan logika ini saat ada input dari filter category dan menghindari nilai 'semua' karena 'semua' bukan termasuk category
        // if ($categoryFilter && $categoryFilter != 'semua') {
        //     $coursesQuery->where('category', $categoryFilter);
        // }

        // ambil data course saat coursesQuery tidak null dan menyimpanya pada memory dengan collection
        // $courses = $coursesQuery ? $coursesQuery->with('users', 'courses')
        //     ->select('id', 'mentor_id', 'cover', 'name', 'category', 'slug', 'created_at', 'price')->get() : collect();

        // Mengembalikan tampilan dengan data yang sudah diproses
        return view('member.course');
    }



    public function join($slug)
    {
        // Mencari data kursus berdasarkan slug terlebih dahulu
        $courses = Course::where('slug', $slug)->first();

        // Logika ketika kursus ditemukan
        if ($courses) {
            // Mengambil data chapter dan lessons yang cocok dengan course
            $chapters = Chapter::with('lessons')->where('course_id', $courses->id)->get();

            // Mengambil data reviews yang cocok dengan course
            $reviews = Review::with('user')->where('course_id', $courses->id)->get();

            // Mengecek apakah kursus memiliki bundling dengan eBook yang terisi
            $bundling = CourseEbook::with(['course', 'ebook'])
                ->where('course_id', $courses->id)
                ->first();

            // Ketika data chapter ada/tidak null maka tampilkan lesson pertama
            $lesson = $chapters->isNotEmpty()
                ? Lesson::with('chapters')->where('chapter_id', $chapters->first()->id)->first()
                : null;

            // Mengecek apakah ada transaksi course pada user
            $transaction = Auth::check()
                ? Transaction::where('user_id', Auth::id())
                ->where('course_id', $courses->id)
                ->orderBy('created_at', 'desc') // cek dari transaksi terbaru
                ->first()
                : null;
            // Mendapatkan data tools yang ada pada course
            $coursetools = Course::with('tools')->findOrFail($courses->id);
            // Placeholder untuk transaksi eBook (jika diperlukan logika tambahan)
            $transactionForEbook = null;
            // Mengecek semua course_id yang termasuk dalam bundling eBook
            $InBundle = CourseEbook::pluck('course_id')->toArray();

            return view('member.joincourse', compact('chapters', 'courses', 'lesson', 'transaction', 'transactionForEbook', 'coursetools', 'reviews', 'bundling'));
        } else {
            // Jika kursus tidak ditemukan, redirect ke halaman error
            return redirect()->route('pages.error');
        }
    }

    public function play($slug, $episode)
    {
        // Mengambil data kursus berdasarkan slug
        $courses = Course::where('slug', $slug)->first();
        // Mengambil data mentor berdasarkan mentor_id dari kursus
        // $user = User::where('id', $courses->mentor_id)->first();

        // Mengambil semua chapter dan lesson terkait kursus
        $chapters = Chapter::with('lessons')->where('course_id', $courses->id)->get();

        // Mengambil data lesson berdasarkan episode
        $play = Lesson::where('episode', $episode)->first();

        // Memeriksa apakah user yang login telah melakukan transaksi untuk kursus ini
        $checkTrx = Transaction::where('course_id', $courses->id)
            ->where('user_id', Auth::user()->id)
            ->first();

        // Memeriksa apakah kursus ini memiliki bundling dengan eBook
        $paketKelas = CourseEbook::where('course_id', $courses->id)->first();

        // Memeriksa apakah user sudah memberikan review untuk kursus ini
        $checkReview = Review::where('user_id', Auth::user()->id)->first();

        // Memeriksa apakah episode yang sedang diputar sudah ditandai sebagai selesai
        $checkCompelete = CompleteEpisodeCourse::where('episode_id', $play->id)
            ->where('course_id', $courses->id)
            ->where('user_id', Auth::user()->id)
            ->first();

        // Jika episode belum ditandai selesai, maka buat data baru di tabel CompleteEpisodeCourse
        if (!$checkCompelete) {
            CompleteEpisodeCourse::create([
                'user_id' => Auth::user()->id,
                'course_id' =>  $courses->id,
                'episode_id' => $play->id
            ]);
        }

        // Mendapatkan daftar episode yang telah selesai untuk user ini di kursus terkait
        $epComplete = CompleteEpisodeCourse::where('course_id', $courses->id)
            ->where('user_id', Auth::user()->id)
            ->pluck('episode_id') // Hanya mengambil ID episode yang selesai
            ->toArray();

        // Memeriksa apakah user memiliki transaksi untuk kursus ini
        if ($checkTrx) {
            // Jika transaksi ditemukan, tampilkan halaman play dengan data terkait
            return view('member.play', compact('play', 'chapters', 'slug', 'courses', 'checkReview', 'paketKelas', 'epComplete'));
        } else {
            // Jika tidak ada transaksi, tampilkan pesan error dan arahkan kembali ke halaman join
            Alert::error('error', 'Maaf Akses Tidak Bisa, Karena Anda belum Beli Kelas!!!');
            return redirect()->route('member.course.join', $slug);
        }
    }



    public function detail($slug)
    {
        // Mengambil data course berdasarkan slug yang diberikan
        $courses = Course::where('slug', $slug)->first();
        // Mengambil semua review untuk course, termasuk data user yang memberikan review
        $reviews = Review::with('user')->where('course_id', $courses->id)->get();
        // Mengambil data mentor (user) yang terkait dengan course
        $user = User::where('id', $courses->mentor_id)->first();
        // Mengambil semua chapter yang terkait dengan course, termasuk data lessons di dalamnya
        $chapters = Chapter::with('lessons')->where('course_id', $courses->id)->get();
        // Memeriksa apakah user yang sedang login sudah membeli course ini
        $checkTrx = Transaction::where('course_id', $courses->id)->where('user_id', Auth::user()->id)->first();
        // Memeriksa apakah user yang sedang login sudah memberikan review untuk course ini
        $checkReview = Review::where('user_id', Auth::user()->id)->where('course_id', $courses->id)->first();
        // Mengambil semua tools yang terkait dengan course
        $coursetools = Course::with('tools')->findOrFail($courses->id);
        // Mengambil data episode yang telah diselesaikan oleh user dalam course ini
        $compeleteEps = CompleteEpisodeCourse::where('user_id', Auth::user()->id)->where('course_id', $courses->id)->get();
        // Menghitung total jumlah lesson di semua chapter
        $totalLesson = 0;
        foreach ($chapters as $chapter) {
            $totalLesson += $chapter->lessons->count();
        }

        // Memeriksa apakah user telah menyelesaikan semua episode dalam course
        $checkSertifikat = false;
        if ($totalLesson == $compeleteEps->count()) {
            $checkSertifikat = true; // Sertifikat dapat diberikan
        }

        // Jika user sudah membeli course
        if ($checkTrx) {
            // Menampilkan halaman detail course untuk member
            return view('member.detail-course', compact('chapters', 'slug', 'courses', 'user', 'checkReview', 'coursetools', 'reviews', 'checkSertifikat'));
        } else {
            // Jika user belum membeli course, tampilkan alert error dan arahkan ke halaman join course
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

            return $pdf->download('sertifikat-' . Auth::user()->name . '.pdf');
        }
        return redirect()->back();
    }
}
