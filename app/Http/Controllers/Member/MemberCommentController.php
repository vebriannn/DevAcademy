<?php
namespace App\Http\Controllers\member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comments;

class MemberCommentController extends Controller
{
    public function addComment(Request $request, $forum_id)
    {
        $request->validate([
            'comment' => 'required|string|max:1000',
        ]);

        Comments::create([
            'forum_id' => $forum_id,
            'user_id' => auth()->id(),
            'comment' => $request->comment,
        ]);

        return redirect()->back();
    }

    public function replyComment(Request $request, $comment_id)
    {
        $request->validate([
            'reply' => 'required|string|max:1000',
        ]);

        Comments::create([
            'forum_id' => Comments::findOrFail($comment_id)->forum_id,
            'user_id' => auth()->id(),
            'comment' => $request->reply,
            'parent_id' => $comment_id,
        ]);

        return redirect()->back();
    }

    // Metode long polling untuk memeriksa komentar baru
    public function getNewComments(Request $request, $forum_id)
    {
        $lastCommentId = $request->input('last_comment_id');

        // Ambil komentar baru beserta balasannya
        $newComments = Comments::where('forum_id', $forum_id)
            ->where('id', '>', $lastCommentId)
            ->with(['user', 'replies.user'])
            ->get();

        return response()->json($newComments);
    }
}
