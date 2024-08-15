<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MemberPaymentController extends Controller
{
    public function index(Request $request)
    {
        $courseId = $request->query('course_id');
        $course = Course::find($courseId);

        if (!$course) {
            abort(404, 'Course not found');
        }

        return view('member.payment', [
            'course' => $course
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:tbl_courses,id',
            'termsCheck' => 'required|accepted',
        ]);

        $courseId = $request->input('course_id');
        $userId = Auth::id();

        // Simpan transaksi
        $transaction = Transaction::create([
            'user_id' => $userId,
            'course_id' => $courseId,
            'status' => 'pending',
        ]);

        return response()->json([
            'message' => 'Transaksi berhasil, pembayaran sedang diproses.',
            'transaction' => $transaction,
        ]);
    }
}
