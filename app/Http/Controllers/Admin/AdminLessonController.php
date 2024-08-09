<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Models\Lesson;

class AdminLessonController extends Controller
{
    public function index($slug, $id_chapter) {
        $lessons = Lesson::where('chapter_id', $id_chapter)->get();
        return view('admin.lesson.view', compact('lessons', 'slug', 'id_chapter'));
    }

    public function create($slug, $id_chapter) {
        return view('admin.lesson.create', compact('slug', 'id_chapter'));
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

    public function edit($slug, $id_chapter, $id_lesson) {
        $lessons = Lesson::where('id', $id_lesson)->first();
        return view('admin.lesson.update', compact('lessons', 'slug', 'id_chapter', 'id_chapter'));
    }

    public function update(Request $requests, $id) {
        $requests->validate([
            'name' => 'required',
            'video' => 'required',
        ]);

        $lesson = Lesson::findOrFail($id);

        if($lesson->first()->video != $requests->video) {
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

        

        return response()->json([
            'message' => 'Data berhasil diedit'
        ], 200);
    }

    public function delete($id_lesson) {
        $lesson = Lesson::findOrFail($id_lesson); 
        $lesson->delete();
        
        return response()->json([
            'message' => 'Data berhasil dihapus'
        ], 200);
    }
}