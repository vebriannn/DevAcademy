<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Chapter;

class AdminChapterController extends Controller
{
    public function index($id) {
        $chapters = Chapter::where('course_id', $id)->get();
        return view('admin.chapter.data-chapter', compact('chapters', 'id'));
    }

    public function create($id) {
        return view('admin.chapter.create-chapter', compact('id'));
    }


    public function store(Request $requests, $id) {
        $requests->validate([
            'name' => 'required',
        ]);
 
        Chapter::create([
            'name' => $requests->name,
            'course_id' => $id, 
        ]);
        
        return response()->json([
            'message' => 'Data berhasil dibuat'
        ], 200);
    }

    public function edit($id) {
        $chapters = Chapter::where('id', $id)->first();
        return view('admin.chapter.edit-chapter', compact('chapters'));
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