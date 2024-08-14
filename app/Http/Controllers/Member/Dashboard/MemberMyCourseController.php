<?php

namespace App\Http\Controllers\Member\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Course;
use App\Models\Transaction;

class MemberMyCourseController extends Controller
{
    public function index() {
        $courses = Course::with(['users', 'transactions' => function ($query) {
            $query->where('user_id', Auth::user()->id);
            $query->where('status', 'success');
        }])->get();
        return view('member.dashboard.mycourse', compact('courses'));
    }
}