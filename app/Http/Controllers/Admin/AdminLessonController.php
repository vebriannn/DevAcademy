<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

use App\Models\Lesson;
use App\Models\Chapter;
use App\Models\CompleteEpisodeCourse;
use App\Models\Course;

class AdminLessonController extends Controller
{
    public function index($slug_course, $id_chapter)
    {
        $lessons = Lesson::where('chapter_id', $id_chapter)->get();
        return view('admin.courses.lessons.view', compact('lessons', 'slug_course', 'id_chapter'));
    }

    public function create($slug_course, $id_chapter)
    {
        return view('admin.courses.lessons.create', compact('slug_course', 'id_chapter'));
    }

    public function store(Request $request, $slug_course, $id_chapter)
    {
        $request->validate([
            'name' => 'required',
            'link_videos' => 'required|url',
        ]);

        $chapter = Chapter::with('course')->findOrFail($id_chapter);

        Lesson::create([
            'chapter_id' => $id_chapter,
            'name' => $request->name,
            'slug_episode' => Str::random(12),
            'link_videos' => $request->link_videos,
        ]);

        return redirect()->route('admin.lesson', ['slug_course' => $slug_course, 'id_chapter' => $chapter->id])
            ->with('success', 'Lesson berhasil dibuat.');
    }

    public function edit($slug_course, $id_chapter, $id_lesson)
    {
        $lesson = Lesson::findOrFail($id_lesson);
        return view('admin.courses.lessons.update', compact('lesson', 'slug_course', 'id_chapter'));
    }

    public function update(Request $request, $slug_course, $id_chapter, $id_lesson)
    {
        $request->validate([
            'name' => 'required',
            'link_videos' => 'required|url',
        ]);

        $lesson = Lesson::findOrFail($id_lesson);

        $lesson->update([
            'name' => $request->name,
            'link_videos' => $request->link_videos,
        ]);

        return redirect()->route('admin.lesson', ['slug_course' => $slug_course, 'id_chapter' => $id_chapter])->with('success', 'Lesson berhasil diubah.');
    }

    public function delete($slug_course, $id_chapter, $id_lesson)
    {
        $lesson = Lesson::findOrFail($id_lesson);

        $lesson->delete();

        return redirect()->route('admin.lesson', [
            'slug_course' => $slug_course,
            'id_chapter' => $id_chapter
        ])->with('success', 'Lesson berhasil dihapus.');
    }
}
