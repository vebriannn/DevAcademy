<?php
namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\Course;
use App\Models\Ebook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MemberPaymentController extends Controller
{
    public function index(Request $request)
    {
        $courseId = $request->query('course_id');
        $ebookId = $request->query('ebook_id');

        $course = Course::find($courseId);
        $ebook = Ebook::find($ebookId); 

        if (!$course && !$ebook) {
            abort(404, 'Course or eBook not found');
        }

        return view('member.payment', [
            'course' => $course,
            'ebook' => $ebook
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'course_id' => 'nullable|exists:tbl_courses,id',
            'ebook_id' => 'nullable|exists:tbl_ebooks,id',
            'termsCheck' => 'required|accepted',
        ]);
    
        $courseId = $request->input('course_id');
        $ebookId = $request->input('ebook_id');
        $userId = Auth::id();
    
        $name = '';
        $price = 0;
        $status = 'pending';
        $course = Course::where('id', $courseId)->first();
    
        if ($courseId && $ebookId) {
            $ebook = Ebook::find($ebookId);
            $name = 'Paket Bundle' . $course->name;
            $price = $course->price + $ebook->price;
        } elseif ($courseId) {
            $name = $course->name . ' (video)';
            $price = $course->price;
        } elseif ($ebookId) {
            $ebook = Ebook::find($ebookId);
            $name = $ebook->name . ' (eBook)';
            $price = $ebook->price;
        }
    
        if($course->price == 0) {
            $status = 'success';
        }
        
        // Save transaction
        $transaction = Transaction::create([
            'user_id' => $userId,
            'course_id' => $courseId,
            'ebook_id' => $ebookId,
            'name' => $name,
            'price' => $price,
            'status' => $status,
        ]);
        return response()->json([
            'message' => 'Transaksi berhasil, pembayaran sedang diproses.',
            'transaction' => $transaction,
        ]);
    }
    
    
}