<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;

class AdminCourseController extends Controller
{
    public function index() {
        $courses = Course::all();
        return response()->json($courses);
        dd($courses);
    }

    public function create() {
        // You can return a view or JSON for creation form if needed.
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'cover' => 'required|string',
            'type' => 'required|in:free,premium',
            'status' => 'required|in:draft,published',
            'price' => 'required|integer',
            'level' => 'required|in:beginner,intermediate,expert',
            'description' => 'nullable|string',
            'mentor_id' => 'required|exists:users,id', 
        ]);
                    
        Course::create([
            'name' => $request->name,
            'cover' => $request->cover,
            'type' => $request->type,
            'status' => $request->status,
            'price' => $request->price,
            'level' => $request->level,
            'description' => $request->description,
            'mentor_id' => $request->mentor_id,
        ]);
        
        return response()->json([
            'message' => 'Course successfully created'
        ], 201); // 201 Created
    }

    public function edit($id) {
        $course = Course::findOrFail($id);
        return response()->json($course);
    }

    public function update(Request $request, $id) {
        $request->validate([
            'name' => 'required|string|max:255',
            'cover' => 'required|string',
            'type' => 'required|in:free,premium',
            'status' => 'required|in:draft,published',
            'price' => 'required|integer',
            'level' => 'required|in:beginner,intermediate,expert',
            'description' => 'nullable|string',
            'mentor_id' => 'required|exists:users,id', // Assuming `users` table for mentor
        ]);

        $course = Course::findOrFail($id);
        
        $course->update([
            'name' => $request->name,
            'cover' => $request->cover,
            'type' => $request->type,
            'status' => $request->status,
            'price' => $request->price,
            'level' => $request->level,
            'description' => $request->description,
            'mentor_id' => $request->mentor_id,
        ]);

        return response()->json([
            'message' => 'Course successfully updated'
        ], 200);
    }

    public function delete($id) {
        $course = Course::findOrFail($id); 
        $course->delete();
        
        return response()->json([
            'message' => 'Course successfully deleted'
        ], 200);
    }
}