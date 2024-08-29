<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

use App\Models\Transaction;

class AdminTransactionController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $userId = Auth::id();

        $transactions = Transaction::with('course')
            ->whereHas('course', function($query) use ($userId) {
                $query->where('mentor_id', $userId);
            })
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);

        return view('admin.transaction.view', compact('transactions'));
    }

    public function accept($id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->status = 'success';
        $transaction->save();

        Alert::success('Success', 'Transctions Berhasil Di Accept');
        return redirect()->route('admin.transaction');
    }

    public function cancel($id)
    {
        // $transaction = Transaction::findOrFail($id);
        // $transaction->delete();
        $transaction = Transaction::findOrFail($id);
        $transaction->status = 'failed';
        $transaction->save();

        Alert::success('Success', 'Transctions Berhasil Di Cancel');
        return redirect()->route('admin.transaction');
    }
}