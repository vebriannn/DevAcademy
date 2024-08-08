<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Chapter;
use App\Models\Course;

class AdminChapterController extends Controller
{
    public function index($slug) {
        $id =  Course::where('slug', $slug)->first()->id;
        
        $chapters = Chapter::where('course_id', $id)->get();
        return view('admin.chapter.view', compact('chapters', 'slug', 'id'));
    }

    public function create($slug, $id_course) {
        return view('admin.chapter.create', compact('slug', 'id_course'));
    }


    public function store(Request $requests, $id_chapter) {
        $requests->validate([
            'name' => 'required',
        ]);
 
        Chapter::create([
            'name' => $requests->name,
            'course_id' => $id_chapter, 
        ]);
        
        return response()->json([
            'message' => 'Data berhasil dibuat'
        ], 200);
    }

    public function edit($slug, $id_chapter) {
        $chapters = Chapter::where('id', $id_chapter)->first();
        return view('admin.chapter.update', compact('chapters', 'slug'));
    }

    public function update(Request $requests, $id) {
        $requests->validate([
            'name' => 'required',
        ]);

        $chapter = Chapter::findOrFail($id);
        
        $chapter->update([
            'name' => $requests->name,
        ]);     


        return response()->json([
            'message' => 'Data berhasil diedit'
        ], 200);
    }

    public function delete($id) {
        $chapter = Chapter::findOrFail($id); 
        $chapter->delete();
        
        return response()->json([
            'message' => 'Data berhasil dihapus'
        ], 200);
    }
}