<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\Lesson;

class AdminLessonController extends Controller
{
    public function index($id) {
        $lessons = Lesson::where('chapter_id', $id)->get();
        return view('admin.lesson.data-lesson', compact('lessons', 'id'));
    }

    public function create($id) {
        return view('admin.lesson.create-data', compact('id'));
    }

    public function store(Request $requests, $id) {
        $requests->validate([
            'name' => 'required',
            'video' => 'required|',
        ]);

        Lesson::create([
            'name' => $requests->name,
            'episode' => Str::random(12),
            'video' => $requests->video,
            'chapter_id' => $id,
        ]);
        
        return response()->json([
            'message' => 'Data berhasil dibuat'
        ], 200);
    }

    public function edit($id) {
        $lessons = Lesson::where('id', $id)->first();
        return view('admin.lesson.edit-data', compact('lessons'));
    }

    public function update(Request $requests, $id) {
        $requests->validate([
            'name' => 'required',
            'video' => 'required|url',
        ]);

        $lesson = Lesson::findOrFail($id);

        $lesson->update([
            'name' => $requests->name,
            'video' => $requests->video,
        ]);     

        return response()->json([
            'message' => 'Data berhasil diedit'
        ], 200);
    }

    public function delete($id) {
        $lesson = Lesson::findOrFail($id); 
        $lesson->delete();
        
        return response()->json([
            'message' => 'Data berhasil dihapus'
        ], 200);
    }
}