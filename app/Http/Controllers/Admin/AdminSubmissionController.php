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
        $users = User::all(); // Ambil semua pengguna
        $mentorsWithCourses = $users->map(function ($mentor) {
            $total_course = Course::whereHas('transactions', function ($query) use ($mentor) {
                $query->where('user_id', $mentor->id)
                    ->where('status', 'success');
            })->count();

            $submission_check = Submission::where('user_id', $mentor->id)->first();

            // check jika tidak ada submission maka bernilai pending
            $status_submission = $submission_check?->status ?? 'pending';

            return [
                'mentor' => $mentor,
                'total_course' => $total_course,
                'submission_status' => $status_submission
            ];
        });

        return view('admin.pengajuan-mentor.view', compact('mentorsWithCourses'));
    }

    public function store(Request $requests, $id)
    {
        $requests->validate([
            'link' => 'required|url',
            'action' => 'required|in:pending,accept',
        ]);

        Submission::create([
            'status' => 'accept',
            'user_id' => $id
        ]);

        $submission = Submission::where('user_id', $id)->first();

        // send mail
        $submission->user->notify(new sendSubmissionMentorNotification($submission, $requests->link));


        Alert::success('Success', 'Pengajuan Berhasil Di Kirim');
        return redirect()->route('admin.pengajuan');
    }
}
