<?php
namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ebook;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaction;

class MemberEbookController extends Controller
{
    public function index($slug)
    {
        $ebooks = Ebook::where('slug', $slug)->first();

        if ($ebooks) {
            if (Auth::user()) {
                $transaction = Transaction::where('user_id', Auth::user()->id)
                    ->where('ebook_id', $ebooks->id)
                    ->orderBy('created_at', 'desc')
                    ->first();
            } else {
                $transaction = null;
            }
            return view('member.joinebook', compact( 'transaction','ebooks'));
        } else {
            return redirect('pages.error');
        }

        return view('member.joinebook', compact('transaction','ebooks'));
    }

    public function read($slug)
    {
        // Cari ebook berdasarkan slug
        $ebook = Ebook::where('slug', $slug)->firstOrFail();
        return view('member.ebook', compact('ebook'));
        // $checkTrx = Transaction::where('ebook_id', $ebook->id)->where('user_id', Auth::user()->id)->first();
        // if($checkTrx){
        //     return view('member.ebook', compact('ebook'));
        // }
        // else{
        //     Alert::error('error', 'Maaf Akses Akses Ditolak, Karena Anda Belum Berlangganan');
        //     return redirect()->route('member.ebook.index', $slug);
        // }
    }
}