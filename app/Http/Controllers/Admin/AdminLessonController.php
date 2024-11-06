<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

use App\Models\Lesson;
use App\Models\Chapter;
use App\Models\Course;

class AdminLessonController extends Controller
{
    public function index($slug_course, $id_chapter) {
        $lessons = Lesson::where('chapter_id', $id_chapter)->get();
        return view('admin.lesson.view', compact('lessons', 'slug_course', 'id_chapter'));
    }

    public function create($slug_course, $id_chapter) {
        return view('admin.lesson.create', compact('slug_course', 'id_chapter'));
    }

    public function store(Request $requests, $id_chapter) {
        $requests->validate([
            'name' => 'required',
            'video' => 'required|',
        ]);

        $chapter = Chapter::where('id', $id_chapter)->first();
        $course = Course::where('id', $chapter->course_id)->first();

        Lesson::create([
            'name' => $requests->name,
            'episode' => Str::random(12),
            'video' => $requests->video,
            'chapter_id' => $id_chapter,
        ]);


        Alert::success('Success', 'Lesson Berhasil Di Buat');
        return redirect()->route('admin.lesson', ['slug_course' => $course->slug, $id_chapter]);
    }

    public function edit(Request $requests, $slug_course, $id_chapter) {
        $id_lesson = $requests->query('id');
        $lessons = Lesson::where('id', $id_lesson)->first();
        return view('admin.lesson.update', compact('lessons', 'slug_course', 'id_chapter'));
    }

    public function update(Request $requests, $id) {
        $requests->validate([
            'name' => 'required',
            'video' => 'required',
        ]);

        $lesson = Lesson::findOrFail($id);
        $chapter = Chapter::where('id', $lesson->first()->chapter_id)->first();
        $course = Course::where('id', $chapter->course_id)->first();

        if(
            $lesson->first()->video != $requests->video) {
            $lesson->update([
                'name' => $requests->name,
                'episode' => Str::random(12),
                'video' => $requests->video,
            ]);
        }
        else {
            $lesson->update([
                'name' => $requests->name,
            ]);
        }

        Alert::success('Success', 'Lesson Berhasil Di Update');
        return redirect()->route('admin.lesson', [$course->slug, 'id_chapter' => $chapter->id]);
    }

    public function delete(Request $requests) {
        $id_lesson = $requests->query('id');
        $lesson = Lesson::where('id', $id_lesson)->first();
        $chapter = Chapter::where('id', $lesson->chapter_id)->first();
        $course = Course::where('id', $chapter->course_id)->first();
        $lesson->delete();

        Alert::success('Success', 'Lesson Berhasil Di Hapus');
        return redirect()->route('admin.lesson', ['slug_course' => $course->slug, 'id_chapter' => $chapter->id]);
    }
}
