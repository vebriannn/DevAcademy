<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

use App\Models\Category;
use App\Models\Course;
use App\Models\Tools;
use App\Models\Chapter;
use App\Models\CompleteEpisodeCourse;
use App\Models\Lesson;
use App\Models\Forum;
use App\Models\Transaction;

class AdminCourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        if ($user->role === 'superadmin') {
            $courses = Course::with('users')->OrderBy('id', 'DESC')->get();
        } else {
            $courses = Course::where('mentor_id', $user->id)->OrderBy('id', 'DESC')->get();
        }

        return view('admin.course-video.view', compact('courses'));
    }



    public function create()
    {
        $category = Category::all();
        $tools = Tools::all();
        return view('admin.course-video.create', compact('category', 'tools'));
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
            'tools' => 'required',
            'tools.*' => 'exists:tbl_tools,id',
            'link_grub' => 'required'
        ]);


        $images = $request->cover;
        $imagesGetNewName = Str::random(10) . $images->getClientOriginalName();
        $images->storeAs('public/images/covers/' . $imagesGetNewName);
        $resources = 'null';


        if ($request->resources) {
            $resources = $request->resources;
        }

        $course = Course::create([
            'category' => $request->category,
            'name' => $request->name,
            'cover' => $imagesGetNewName,
            'type' => $request->type,
            'status' => $request->status,
            'price' => $request->price,
            'level' => $request->level,
            'description' => $request->description,
            'resources' => $resources,
            'link_grub' => $request->link_grub,
            'mentor_id' => Auth::user()->id,
        ]);
        $course->tools()->sync($request->tools);

        Alert::success('Success', 'Course Berhasil Di Buat');
        return redirect()->route('admin.course');
    }

    public function edit(Request $requests)
    {
        $id = $requests->query('id');
        $category = Category::all();
        $course = Course::where('id', $id)->first();
        $tools = Tools::all();
        $coursetool = Course::with('tools')->findOrFail($course->id);
        return view('admin.course-video.update', compact('course', 'category', 'coursetool', 'tools'));
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
            'description' => 'required|string',
            'tools' => 'required',
            'tools.*' => 'exists:tbl_tools,id',
            'link_grub' => 'required',
        ]);

        $images = $request->cover;

        if ($images) {
            $imagesGetNewName = Str::random(10) . $images->getClientOriginalName();
            $images->storeAs('public/images/covers/' . $imagesGetNewName);
            $data['cover'] = $imagesGetNewName;
            Storage::delete('public/images/covers/' . $course->cover);
        } else {
            $data['cover'] = $course->cover;
        }

        $slug = Str::slug($request->name);

        $resources = 'null';

        if ($request->resources) {
            $resources = $request->resources;
        }
        $course->update([
            'category' => $request->category,
            'name' => $request->name,
            'slug' => $slug,
            'cover' => $data['cover'],
            'type' => $request->type,
            'status' => $request->status,
            'price' => $request->price,
            'level' => $request->level,
            'resources' => $resources,
            'link_grub' => $request->link_grub,
            'description' => $request->description,
        ]);

        $course->tools()->sync($request->tools);

        Alert::success('Success', 'Course Berhasil Di Update');
        return redirect()->route('admin.course');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Request $requests)
    {
        // id course
        $id = $requests->query('id');

        $course = Course::where('id', $id)->first();

        // check course
        if (!$course) {
            return response()->json(['error' => 'Course not found'], 404);
        }

        // Delete images course
        if ($course->cover && Storage::exists('public/images/covers/' . $course->cover)) {
            Storage::delete('public/images/covers/' . $course->cover);
        }

        // ambil semua chapters dari id course
        $chapters = Chapter::where('course_id', $id)->get();

        // foreach semua chapter dan semua lesson yang mempunyai id course sama untuk hapus lesson
        foreach ($chapters as $chapter) {
            Lesson::where('chapter_id', $chapter->id)->each(function ($lesson) {
                $totalep = CompleteEpisodeCourse::where('episode_id', $lesson->id)->count();

                if ($totalep > 0) {
                    CompleteEpisodeCourse::where('episode_id', $lesson->id)->delete();
                }


                $lesson->delete();
            });

            $chapter->delete();
        }

        Transaction::where('course_id', $id)->delete();
        $course->delete();
        Alert::success('Success', 'Course Berhasil Di Delete');
        return redirect()->route('admin.course');
    }
}
