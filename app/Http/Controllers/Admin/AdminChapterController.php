<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\CompleteEpisodeCourse;

class AdminChapterController extends Controller
{
    protected $course;

    public function __construct(Course $course)
    {
        $this->course = $course;
    }

    public function index($slug_course)
    {
        $course = $this->course->where('slug', $slug_course)->firstOrFail();
        $chapters = $course->chapters()->orderBy('created_at', 'ASC')->get();

        return view('admin.courses.chapters.view', compact('course', 'chapters'));
    }

    public function create($slug_course)
    {
        $course = $this->course->where('slug', $slug_course)->firstOrFail();

        return view('admin.courses.chapters.create', compact('course'));
    }

    public function store(Request $request, $slug_course)
    {
        $course = $this->course->where('slug', $slug_course)->firstOrFail();

        $request->validate(['name' => 'required|string|max:255']);

        $course->chapters()->create(['name' => $request->name]);

        return redirect()->route('admin.chapter', $slug_course)->with('success', 'Chapter berhasil dibuat.');
    }

    public function edit($slug_course, $id)
    {
        $course = $this->course->where('slug', $slug_course)->firstOrFail();
        $chapter = $course->chapters()->findOrFail($id);

        return view('admin.courses.chapters.update', compact('course', 'chapter'));
    }

    public function update(Request $request, $slug_course, $id)
    {
        $request->validate(['name' => 'required|string|max:255']);

        $course = $this->course->where('slug', $slug_course)->firstOrFail();
        $chapter = $course->chapters()->findOrFail($id);

        $chapter->update(['name' => $request->name]);

        return redirect()->route('admin.chapter', $slug_course)->with('success', 'Chapter berhasil diubah.');
    }

    public function delete($slug_course, $id)
    {
        $course = $this->course->where('slug', $slug_course)->firstOrFail();
        $chapter = $course->chapters()->findOrFail($id);

        // Hapus semua lesson dan episode terkait
        $chapter->lessons->each(function ($lesson) {
            CompleteEpisodeCourse::where('episode_id', $lesson->id)->delete();
            $lesson->delete();
        });

        $chapter->delete();

        return redirect()->route('admin.chapter', $slug_course)->with('success', 'Chapter berhasil dihapus.');
    }
}
