<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;

use App\Models\Submission;
use App\Models\Course;
use App\Models\User;
use App\Mail\MailNotificationMentor;
use App\Notifications\sendSubmissionMentorNotification;

class AdminSubmissionController extends Controller
{
    public function index()
    {
        $users = Submission::with('user')->get();
        $total_course = 0;

        // check total course
        foreach ($users  as $mentor) {
            $total_course = Course::with(['transactions' => function ($query) use ($mentor) {
                $query->where('user_id', $mentor->user->id);
                $query->where('status', 'success');
            }])->count();
        }

        return view('admin.pengajuan-mentor.view', compact('users', 'total_course'));
    }

    public function update(Request $requests, $id)
    {
        $requests->validate([
            'link' => 'required|url',
            'action' => 'required|in:pending,accept',
        ]);

        $submission = Submission::where('user_id', $id)->first();

        if ($submission) {
            
            // send mail
            $submission->user->notify(new sendSubmissionMentorNotification($submission, $requests->link));

            $submission->update([
                'status' => $requests->action,
            ]);

            Alert::success('Success', 'Pengajuan Berhasil Di Kirim');
            return redirect()->route('admin.pengajuan');
        }
    }
}
