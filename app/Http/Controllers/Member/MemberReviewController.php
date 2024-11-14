<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;
use App\Models\Ebook;

class MemberReviewController extends Controller
{
    /**
     * Display a listing of the reviews.
     */
    public function index($slug)
    {
        $course = Course::where('slug', $slug)->firstOrFail();
        $checkTrx = Transaction::where('course_id', $course->id)->where('user_id', Auth::user()->id)->first();
        
        if ($checkTrx) {
            return view('member.review', compact('course'));
        } else {
            Alert::error('error', 'Maaf Akses Tidak Bisa, Karena Anda belum Beli Kelas!!!');
            return redirect()->route('member.course.join', $slug);
        }
    }    
    

    /**
     * Store a newly created review in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'course_id' => 'required|exists:tbl_courses,id',
            'note' => 'nullable|string|min:1|max:100',
        ]);
        $course = Course::findOrFail($validated['course_id']);
        $checkReview = Review::where('user_id', Auth::user()->id)
                             ->where('course_id', $course->id)
                             ->first();
        if ($checkReview) {
            Alert::error('error', 'Anda Sudah Melakukan Review.');
            return redirect()->route('member.course.detail', ['slug' => $course->slug])
                ->with('error', 'Review gagal ditambahkan.');
        } else {
            Review::create([
                'user_id' => Auth::id(),
                'course_id' => $validated['course_id'],
                'note' => $validated['note'],
            ]);
            Alert::success('success', 'Review berhasil ditambahkan.');
            return redirect()->route('member.course.detail', ['slug' => $course->slug])
                ->with('success', 'Review berhasil ditambahkan.');
        }
    }    

    public function ebookFormReview($slug)
    {
        $ebook = Ebook::where('slug', $slug)->firstOrFail();
        $checkTrx = Transaction::where('ebook_id', $ebook->id)->where('user_id', Auth::user()->id)->first();
        // return view('member.review-ebook', compact('ebook'));
        if ($checkTrx) {
            return view('member.review-ebook', compact('ebook'));
        } else {
            Alert::error('error', 'Maaf Akses Tidak Bisa, Karena Anda belum Beli Kelas!!!');
            return redirect()->route('member.ebook.join', $slug);
        }
    }    
    

    /**
     * Store a newly created review in storage.
     */
    public function storeReviewEbook(Request $request)
    {
        $validated = $request->validate([
            'ebook_id' => 'required|exists:tbl_ebooks,id',
            'note' => 'nullable|string|min:1|max:100',
        ]);
    
        // Find the course by course_id to get its slug for the redirection
        $ebook = Ebook::findOrFail($validated['ebook_id']);
        $checkReview = Review::where('user_id', Auth::user()->id)->where('ebook_id', $ebook->id)->first();
        if ($checkReview) {
            Alert::error('error', 'Anda Sudah Melakukan Review');
            return redirect()->route('member.ebook.detail', ['slug' => $ebook->slug])
            ->with('error', 'Review gagal ditambahkan.');
        } else {
            Review::create([
                'user_id' => Auth::id(),
                'ebook_id' => $validated['ebook_id'],
                'note' => $validated['note'],
            ]);
            Alert::success('success', 'Review berhasil ditambahkan.');
            return redirect()->route('member.ebook.detail', ['slug' => $ebook->slug])
            ->with('success', 'Review berhasil ditambahkan.');
        }
    }
    
    
}