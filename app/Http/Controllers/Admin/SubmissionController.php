<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Submission;

class SubmissionController extends Controller
{
    public function index()
    {
        $submissions = Submission::all();
        return response()->json([
            'data' => $submissions
        ], 200);
    }

    public function create()
    {
        return response()->json([
            'message' => 'Create submission form',
            // You can return additional data needed for creating a submission if required
        ], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'status' => 'required|in:pending,accept,deaccept',
            'user_id' => 'required|exists:users,id',
        ]);

        $submission = Submission::create([
            'status' => $request->status,
            'user_id' => $request->user_id,
        ]);

        return response()->json([
            'message' => 'Submission created successfully',
            'data' => $submission
        ], 201);
    }

    public function edit($id)
    {
        $submission = Submission::find($id);

        if (!$submission) {
            return response()->json([
                'message' => 'Submission not found'
            ], 404);
        }

        return response()->json([
            'message' => 'Edit submission form',
            'data' => $submission
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,accept,deaccept',
            'user_id' => 'required|exists:users,id',
        ]);

        $submission = Submission::find($id);

        if (!$submission) {
            return response()->json([
                'message' => 'Submission not found'
            ], 404);
        }

        $submission->update([
            'status' => $request->status,
            'user_id' => $request->user_id,
        ]);

        return response()->json([
            'message' => 'Submission updated successfully',
            'data' => $submission
        ], 200);
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
