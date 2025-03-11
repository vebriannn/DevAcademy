<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use App\Models\Category;
use App\Models\Course;
use App\Models\Tools;
use App\Models\Chapter;
use App\Models\CompleteEpisodeCourse;
use App\Models\Lesson;

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
        return view('admin.courses.view', compact('courses'));
    }



    public function create()
    {
        $categories = Category::all();
        $tools = Tools::all();
        return view('admin.courses.create', compact('categories', 'tools'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // dd($request->all());
        $request->validate([
            'category' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'cover' => 'required|image|mimes:jpeg,png,jpg|max:5048',
            'type' => 'required|in:free,premium',
            'status' => 'required|in:draft,published',
            'price' => 'required|integer|min:0',
            'level' => 'required|in:beginner,intermediate,expert',
            'sort_description' => 'required|string|max:500',
            'long_description' => 'required|string',
            'link_resources' => 'nullable|url',
            'link_groups' => 'nullable|url',
            'tools' => 'required|array',
            'tools.*' => 'exists:tbl_tools,id',
        ]);

        $images = $request->cover;
        $imagesGetNewName = Str::random(10) . $images->getClientOriginalName();
        $images->storeAs('public/images/covers/' . $imagesGetNewName);

        $course = Course::create([
            'mentor_id' => Auth::user()->id,
            'category' => $request->category,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'cover' => $imagesGetNewName,
            'type' => $request->type,
            'status' => $request->status,
            'price' => $request->price,
            'level' => $request->level,
            'sort_description' => $request->sort_description,
            'long_description' => $request->long_description,
            'link_resources' => $request->link_resources ?? '',
            'link_groups' => $request->link_grub ?? '',
        ]);

        $course->tools()->sync($request->tools);

        return redirect()->route('admin.course')->with('success', 'Kursus berhasil dibuat');
    }

    public function edit(Request $requests, $id)
    {
        $category = Category::all();
        $course = Course::where('id', $id)->first();
        $tools = Tools::all();
        $coursetool = Course::with('tools')->findOrFail($course->id);
        return view('admin.courses.update', compact('course', 'category', 'coursetool', 'tools'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $course = Course::findOrFail($id);

        $request->validate([
            'category' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg|max:5048',
            'type' => 'required|in:free,premium',
            'status' => 'required|in:draft,published',
            'price' => 'required|integer|min:0',
            'level' => 'required|in:beginner,intermediate,expert',
            'sort_description' => 'required|string|max:500',
            'long_description' => 'required|string',
            'link_resources' => 'nullable|url',
            'link_groups' => 'nullable|url',
            'tools' => 'required|array',
            'tools.*' => 'exists:tbl_tools,id',
        ]);

        // Handle cover upload
        if ($request->hasFile('cover')) {
            $images = $request->file('cover');
            $imagesGetNewName = Str::random(10) . '_' . $images->getClientOriginalName();
            $images->storeAs('public/images/covers', $imagesGetNewName);

            // Hapus cover lama
            if ($course->cover) {
                Storage::delete('public/images/covers/' . $course->cover);
            }
            $course->cover = $imagesGetNewName;
        }

        $slug = Str::slug($request->name);

        // Update course
        $course->update([
            'category' => $request->category,
            'name' => $request->name,
            'slug' => $slug,
            'cover' => $course->cover,
            'type' => $request->type,
            'status' => $request->status,
            'price' => $request->price,
            'level' => $request->level,
            'sort_description' => $request->sort_description,
            'long_description' => $request->long_description,
            'link_resources' => $request->link_resources ?? '',
            'link_groups' => $request->link_groups ?? '',
        ]);

        // Sinkronisasi tools
        $course->tools()->sync($request->tools);

        return redirect()->route('admin.course')->with('success', 'Kursus berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Request $requests, $id)
    {
        $course = Course::find($id);

        if (!$course) {
            return redirect()->route('admin.course')->with('error', 'Maaf, kursus tidak ditemukan.');
        }

        DB::beginTransaction();

        try {
            // Hapus cover jika ada
            if ($course->cover && Storage::exists('public/images/covers/' . $course->cover)) {
                Storage::delete('public/images/covers/' . $course->cover);
            }

            // Hapus semua lesson yang terkait dengan chapters
            $chapters = Chapter::where('course_id', $id)->get();

            foreach ($chapters as $chapter) {
                // Hapus semua episode yang telah diselesaikan (CompleteEpisodeCourse)
                $lessons = Lesson::where('chapter_id', $chapter->id)->get();
                foreach ($lessons as $lesson) {
                    CompleteEpisodeCourse::where('episode_id', $lesson->id)->delete();
                    $lesson->delete();
                }

                // Hapus chapter
                $chapter->delete();
            }

            // Hapus semua relasi tools
            $course->tools()->detach();

            // Hapus course
            $course->delete();

            DB::commit();

            return redirect()->route('admin.course')->with('success', 'Kursus berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.course')->with('error', 'Terjadi kesalahan saat menghapus kursus.');
        }
    }
}
