<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaction;

class MemberTransactionController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);

        $transactions = Transaction::with('course')
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);

        return view('member.dashboard.transaction.view', compact('transactions'));
    }

    public function cancel($id)
    {
        $transaction = Transaction::findOrFail($id);

        if ($transaction->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $transaction->delete();

        return redirect()->route('member.transaction')->with('success', 'Transaction cancelled successfully.');
    }
}
