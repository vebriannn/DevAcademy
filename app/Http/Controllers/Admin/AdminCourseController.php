<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminCourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $courses = Course::with('users')->get();
        return view('usercourse', ['courses' => $courses]);
    }
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg',
            'type' => 'required|in:free,premium',
            'status' => 'required|in:draft,published',
            'price' => 'required|integer',
            'level' => 'required|in:beginner,intermediate,expert',
            'description' => 'nullable|string',
            'mentor_id' => 'required|exists:users,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $course = new Course();
        $course->category = $request->category;
        $course->name = $request->name;

        if ($request->hasFile('cover')) {
            $file = $request->file('cover');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/images/covers', $filename);
            $course->cover = $filename;
        }

        $course->type = $request->type;
        $course->status = $request->status;
        $course->price = $request->price;
        $course->level = $request->level;
        $course->description = $request->description;
        $course->mentor_id = $request->mentor_id;
        $course->save();


        return response()->json(['message' => 'Course created successfully', 'course' => $course], 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $course = Course::find($id);

        if (!$course) {
            return response()->json(['error' => 'Course not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'category' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'type' => 'required|in:free,premium',
            'status' => 'required|in:draft,published',
            'price' => 'required|integer',
            'level' => 'required|in:beginner,intermediate,expert',
            'description' => 'nullable|string',
            'mentor_id' => 'required|exists:users,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $course->category = $request->category;
        $course->name = $request->name;

        if ($request->hasFile('cover')) {
            // Delete old cover file if exists
            if ($course->cover && Storage::exists('public/images/covers/' . $course->cover)) {
                Storage::delete('public/images/covers/' . $course->cover);
            }

            $file = $request->file('cover');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/images/covers', $filename);
            $course->cover = $filename;
        }

        $course->type = $request->type;
        $course->status = $request->status;
        $course->price = $request->price;
        $course->level = $request->level;
        $course->description = $request->description;
        $course->mentor_id = $request->mentor_id;
        
        $course->save();

        return response()->json(['message' => 'Course updated successfully', 'course' => $course]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        $course = Course::find($id);

        if (!$course) {
            return response()->json(['error' => 'Course not found'], 404);
        }

        // Delete cover file if exists
        if ($course->cover && Storage::exists('public/images/covers/' . $course->cover)) {
            Storage::delete('public/images/covers/' . $course->cover);
        }

        $course->delete();
        return response()->json(['message' => 'Course deleted successfully']);
    }
}