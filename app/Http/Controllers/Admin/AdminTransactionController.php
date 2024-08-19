<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

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

        return redirect()->route('admin.transaction')->with('success', 'Transaction accepted successfully.');
    }

    public function cancel($id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->delete();

        return redirect()->route('admin.transaction')->with('success', 'Transaction canceled successfully.');
    }
}
