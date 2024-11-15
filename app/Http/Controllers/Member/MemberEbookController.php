<?php
namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ebook;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaction;
use App\Models\Review;
use App\Models\User;
use App\Models\CourseEbook;
use RealRashid\SweetAlert\Facades\Alert;


class MemberEbookController extends Controller
{
    public function index($slug)
    {
        $ebooks = Ebook::where('slug', $slug)->first();

        if ($ebooks) {
            $reviews = Review::with('user')->where('ebook_id', $ebooks->id)->get();
            if (Auth::user()) {
                $transaction = Transaction::where('user_id', Auth::user()->id)
                    ->where('ebook_id', $ebooks->id)
                    ->orderBy('created_at', 'desc')
                    ->first();
            } else {
                $transaction = null;
            }
            $InBundle = CourseEbook::pluck('ebook_id')->toArray();   
            
            return view('member.joinebook', compact( 'transaction','ebooks','reviews','InBundle'));
        } else {
            return redirect('pages.error');
        }

        return view('member.joinebook', compact('transaction','ebooks','reviews'));
    }

    public function read($slug)
    {
        // Cari ebook berdasarkan slug
        $ebook = Ebook::where('slug', $slug)->firstOrFail();
        $checkReview = Review::where('user_id', Auth::user()->id)->where('ebook_id', $ebook->id)->first();
        $checkTrx = Transaction::where('ebook_id', $ebook->id)->where('user_id', Auth::user()->id)->first();
        if($checkTrx){
            return view('member.ebook', compact('ebook','checkReview'));
        }
        else{
            Alert::error('error', 'Maaf Akses Akses Ditolak, Karena Anda Belum Berlangganan');
            return redirect()->route('member.ebook.index', $slug);
        }

        // return view('member.ebook', compact('ebook'));
    }
    public function detail($slug){
        $ebooks = Ebook::where('slug', $slug)->first();
        $reviews = Review::with('user')->where('ebook_id', $ebooks->id)->get();
        $user = User::where('id', $ebooks->mentor_id)->first();
        $checkTrx = Transaction::where('ebook_id', $ebooks->id)->where('user_id', Auth::user()->id)->first();
        $checkReview = Review::where('user_id', Auth::user()->id)->where('ebook_id', $ebooks->id)->first();
        // return view('member.detail-ebook', compact('user', 'checkReview','reviews','ebooks'));

        if ($checkTrx) {
            return view('member.detail-ebook', compact('ebooks', 'user', 'checkReview','reviews','checkTrx'));
        } else {
            Alert::error('error', 'Maaf Akses Tidak Bisa, Karena Anda belum Beli Kelas!!!');
            return redirect()->route('member.course.join', $slug);
        }

    }
}