<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Transaction;


class MemberTransactionController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $status = $request->input('status'); 

        $transactions = Transaction::with([
                'course' => function ($query) {
                    $query->select('id', 'name', 'cover', 'price');
                },
                'ebook' => function ($query) {
                    $query->select('id', 'name', 'cover', 'price');
                },
                'bundle.course' => function ($query) {
                    $query->select('id', 'name', 'cover', 'price');
                }
            ])
            ->where('user_id', Auth::id())
            ->when($status, function ($query, $status) {
                return $query->where('status', $status);
            })
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);

        return view('member.dashboard.transaction.view', compact('transactions', 'status'));
    }

    
    
    public function cancel($id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->delete();
        Alert::success('Success', 'Transaction Berhasil Di Cancel');
        return redirect()->route('member.transaction');
    }
    
}