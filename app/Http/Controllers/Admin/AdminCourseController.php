<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use App\Models\Category;
use App\Models\Course;
use App\Models\Tools;

class AdminCourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {
        $user = Auth::user();
        $courses = Course::where('mentor_id', $user->id)->get();
        return view('admin.coursesvideo.view', compact('courses'));
    }

    public function create() {
        $category = Category::all();
        $tools = Tools::all();
        return view('admin.coursesvideo.create', compact('category', 'tools'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'cover' => 'required|image|mimes:jpeg,png,jpg',
            'type' => 'required|in:free,premium',
            'status' => 'required|in:draft,published',
            'price' => 'required|integer',
            'level' => 'required|in:beginner,intermediate,expert',
            'description' => 'required|string',
            'tools.*' => 'exists:tbl_tools,id',
        ]); 


        $images = $request->cover;
        $imagesGetNewName = Str::random(10).$images->getClientOriginalName();
        $images->storeAs('public/images/covers/'.$imagesGetNewName);

        $course = Course::create([
            'category' => $request->category,
            'name' => $request->name,
            'cover' => $imagesGetNewName,
            'type' => $request->type,
            'status' => $request->status,
            'price' => $request->price,
            'level' => $request->level,
            'description' => $request->description,
            'mentor_id' => Auth::user()->id,
        ]);

        // Simpan relasi dengan tools
        $course->tools()->sync($request->tools);
        
        return response()->json(['message' => 'Course created successfully', 'course' => $course], 201);
    }

    public function edit($id) {
        $category = Category::all();
        $course = Course::where('id', $id)->first();
        $coursetool = Course::with('tools')->get();
        return view('admin.coursesvideo.update', compact('course', 'category', 'coursetool'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $course = Course::where('id', $id)->first();

        $request->validate([
            'category' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'type' => 'required|in:free,premium',
            'status' => 'required|in:draft,published',
            'price' => 'required|integer',
            'level' => 'required|in:beginner,intermediate,expert',
            'description' => 'required|string'
        ]);

        $images = $request->cover;
        
        if($images) {
            $imagesGetNewName = Str::random(10).$images->getClientOriginalName();
            $images->storeAs('public/images/covers/'.$imagesGetNewName);
            $data['cover'] = $imagesGetNewName;
            Storage::delete('public/images/covers/' . $course->cover);
        }
        else {
            $data['cover'] = $course->cover;
        }

        $slug = Str::slug($request->name);
        
        $course->update([
            'category' => $request->category,
            'name' => $request->name,
            'slug' => $slug,
            'cover' => $data['cover'],
            'type' => $request->type,
            'status' => $request->status,
            'price' => $request->price,
            'level' => $request->level,
            'description' => $request->description,
        ]);  

        return response()->json([
            'message' => 'Data berhasil diedit',
            'course' => $course
        ], 200);
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