<?php

namespace App\Http\Controllers\Member\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

use App\Models\Course;
use App\Models\Ebook;
use App\Models\Transaction;
use App\Models\Submission;
use App\Models\MyListCourse;

class MemberMyCourseController extends Controller
{
    public function index(Request $request) {
        $filter = $request->input('filter');
        $lists = MyListCourse::where('user_id', Auth::user()->id)->get();
        $courseIds = $lists->pluck('course_id');
        $ebookIds = $lists->pluck('ebook_id');
        $coursesQuery = Course::whereIn('id', $courseIds)->orderBy('id', 'DESC');
        $ebooksQuery = Ebook::whereIn('id', $ebookIds)->orderBy('id', 'DESC');
        switch ($filter) {
            case 'kursus':
                $courses = $coursesQuery->get();
                $ebooks = collect();
                break;
            case 'ebook':
                $courses = collect();
                $ebooks = $ebooksQuery->get();
                break;
            default:
                $courses = $coursesQuery->get();
                $ebooks = $ebooksQuery->get();
                break;
        }
    
        $total_course = Transaction::where('user_id', Auth::user()->id)->where('status', 'success')->count();
        $submission = Submission::where('user_id', Auth::user()->id)->first();
    
        return view('member.dashboard.mycourse', compact('courses', 'ebooks', 'submission', 'total_course'));
    }
    

    public function reqMentor(Request $requests, $id) {

        $user = Submission::where('user_id', $id)->first();

        if(!$user) {
            Submission::create([
                'status' => 'pending',
                'user_id' => $id
            ]);
        }

        Alert::success('success', 'Pengajuan Berhasil Di Kirim, Mohon Tunggu Sampai Admin Konfirmasi');
        return redirect()->route('member.dashboard');
    }
}
