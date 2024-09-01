<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Forum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;

class AdminForumController extends Controller
{
    public function index(Request $request) {
        $user = Auth::user();
        $perPage = $request->input('per_page', 10);
        if ($user->role === 'superadmin') {
            $forums = Forum::paginate($perPage);
        } else {
            $forums = Forum::where('user_id', $user->id)->paginate($perPage);
        }
        return view('admin.forum.view', compact('forums'));
    }
    public function show($slug)
    {
        $course = Course::where('slug', $slug)->firstOrFail();
        $forum = $course->forum()->with('comments.replies')->firstOrFail();
        $comments = $forum->comments()->whereNull('parent_id')->with('replies')->paginate(10);
        return view('member.forum', compact('course', 'forum', 'comments'));
        
    }

}
