<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

use App\Models\Chapter;
use App\Models\Course;
use App\Models\Lesson;

class AdminChapterController extends Controller
{
    public function index($slug_course) {
        $id_course =  Course::where('slug', $slug_course)->first()->id;

        $chapters = Chapter::where('course_id', $id_course)->orderBy('created_at', 'ASC')->get();
        return view('admin.chapter.view', compact('slug_course', 'chapters', 'id_course'));
    }

    public function create($slug_course) {
        return view('admin.chapter.create', compact('slug_course'));
    }


    public function store(Request $requests, $slug_course) {

        $id = Course::where('slug', $slug_course)->first()->id;

        $requests->validate([
            'name' => 'required',
        ]);

        Chapter::create([
            'name' => $requests->name,
            'course_id' => $id,
        ]);

        Alert::success('Success', 'Chapter Berhasil Di Buat');
        return redirect()->route('admin.chapter', $slug_course);
    }

    public function edit(Request $requests, $slug_course) {
        $id = $requests->query('id');
        $chapters = Chapter::where('id', $id)->first();
        return view('admin.chapter.update', compact('chapters', 'slug_course'));
    }

    public function update(Request $requests, $slug_course ,$id_chapter) {
        $requests->validate([
            'name' => 'required',
        ]);

        $chapter = Chapter::where('id', $id_chapter)->first();

        $chapter->update([
            'name' => $requests->name,
        ]);

        Alert::success('Success', 'Chapter Berhasil Di Edit');
        return redirect()->route('admin.chapter', $slug_course);
    }

    public function delete(Request $requests) {
        $id = $requests->query('id');

        $chapter = Chapter::where('id', $id)->first();

        Lesson::where('chapter_id', $chapter->id)->delete();
        $chapter->delete();

        Alert::success('Success', 'Chapter Berhasil Di Hapus');
        return redirect()->back();
    }
}
