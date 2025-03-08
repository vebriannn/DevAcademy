<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

use App\Models\Transaction;
use App\Models\Course;
use App\Models\MyListCourse;

class AdminTransactionController extends Controller
{
    public function index(Request $request)
    {
        $userId = Auth::id();
        $transactions = Transaction::orderByRaw("CASE WHEN status = 'pending' THEN 0 ELSE 1 END, created_at DESC")->get();
        // Mengembalikan view dengan transaksi
        return view('admin.transaction.view', compact('transactions'));
    }

    public function accept($id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->status = 'success';
        $transaction->save();
        MyListCourse::create([
            'user_id' => $transaction->user_id,
            'course_id' => $transaction->course_id,
        ]);

        return redirect()->route('admin.transaction')->with('success', 'Transaksi Berhasil Di Selesaikan');
    }

    public function cancel($id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->status = 'failed';
        $transaction->save();


        return redirect()->route('admin.transaction')->with('success', 'Transaksi Berhasil Di Batalkan');
    }
}
