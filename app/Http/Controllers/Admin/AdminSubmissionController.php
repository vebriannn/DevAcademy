<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use App\Models\Submission;
use App\Models\Course;
use App\Models\User;
use App\Mail\MailNotificationMentor;

class AdminSubmissionController extends Controller
{
    public function index()
    {
        $mentors = Submission::with('user')->get();

        // check total course
        foreach ($mentors as $mentor) {
            $total_course = Course::with(['transactions' => function ($query) use ($mentor)  {
                $query->where('user_id', $mentor->user->id);
                $query->where('status', 'success');
            }])->count();
        }
        // dd($mentors);
        return view('admin.pengajuanmentor.view', compact('mentors', 'total_course'));
    }

    // public function create()
    // {
    //     return response()->json([
    //         'message' => 'Create submission form',
    //         // You can return additional data needed for creating a submission if required
    //     ], 200);
    // }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'status' => 'required|in:pending,accept,deaccept',
    //         'user_id' => 'required|exists:users,id',
    //     ]);

    //     $submission = Submission::create([
    //         'status' => $request->status,
    //         'user_id' => $request->user_id,
    //     ]);

    //     return response()->json([
    //         'message' => 'Submission created successfully',
    //         'data' => $submission
    //     ], 201);
    // }

    // public function edit($id)
    // {
    //     $submission = Submission::find($id);

    //     if (!$submission) {
    //         return response()->json([
    //             'message' => 'Submission not found'
    //         ], 404);
    //     }

    //     return response()->json([
    //         'message' => 'Edit submission form',
    //         'data' => $submission
    //     ], 200);
    // }

    public function update(Request $request, $id)
    {
        $request->validate([
            'action' => 'required|in:pending,accept,deaccept',
        ]);

        $submission = Submission::where('user_id', $id)->first();

        if($submission) {
            $submission->update([
                'status' => $request->action,
            ]);
            
            $user = User::where('id', $id)->first();
            
            if($request->action == 'accept') {
                $user->update([
                    'role' => 'mentor'
                ]);
            }

            // send mail
            Mail::to($user->email)->send(new MailNotificationMentor($request->action));

            return response()->json([
                'message' => 'Submission updated successfully',
                'data' => $submission
            ], 200);
        }
    }

    public function delete($id)
    {
        $submission = Submission::find($id);

        if (!$submission) {
            return response()->json([
                'message' => 'Submission not found'
            ], 404);
        }

        $submission->delete();

        return response()->json([
            'message' => 'Submission deleted successfully'
        ], 200);
    }
}