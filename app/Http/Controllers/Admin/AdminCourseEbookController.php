<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;

use App\Models\Course;
use App\Models\CourseEbook;
use App\Models\Ebook;


class AdminCourseEbookController extends Controller
{
    public function index(Request $requests)
    {
        $paketKelas = CourseEbook::with(['course', 'ebook'])->get();
        return view('admin.paket-kelas.view', compact('paketKelas'));
    }

    public function create()
    {
        $courses = Course::where('mentor_id', Auth::user()->id)->get();
        $ebooks = Ebook::where('mentor_id', Auth::user()->id)->get();
        return view('admin.paket-kelas.create', compact('courses', 'ebooks'));
    }

    public function store(Request $requests)
    {
        $requests->validate([
            'name_course' => 'required',
            'name_ebook' => 'required',
            'type' => 'required|in:free,premium',
            'status' => 'required|in:draft,published',
            'price' => 'required|integer',

        ]);

        $course_id = Course::where('name', $requests->name_course)->first()->id;
        $ebook_id = Ebook::where('name', $requests->name_ebook)->first()->id;

        CourseEbook::create([
            'course_id' => $course_id,
            'ebook_id' => $ebook_id,
            'type' => $requests->type,
            'status' => $requests->status,
            'price' => $requests->price,
            'mentor_id' => Auth::user()->id
        ]);


        Alert::success('Success', 'Paket Berhasil Di Buat');
        return redirect()->route('admin.paket-kelas');
    }

    public function edit(Request $requests)
    {
        $id = $requests->query('id');
        $paketKelas = CourseEbook::with(['course', 'ebook'])->where('id', $id)->first();
        $courses = Course::where('mentor_id', Auth::user()->id)->get();
        $ebooks = Ebook::where('mentor_id', Auth::user()->id)->get();
        return view('admin.paket-kelas.update', compact('courses', 'ebooks', 'paketKelas'));
    }

    public function update(Request $requests, $id)
    {
        $requests->validate([
            'name_course' => 'required',
            'name_ebook' => 'required',
            'type' => 'required|in:free,premium',
            'status' => 'required|in:draft,published',
            'price' => 'required|integer',
        ]);


        $courseEbook = CourseEbook::where('id', $id)->first();

        $course_id = Course::where('name', $requests->name_course)->first()->id;
        $ebook_id = Ebook::where('name', $requests->name_ebook)->first()->id;

        $courseEbook->update([
            'course_id' => $course_id,
            'ebook_id' => $ebook_id,
            'type' => $requests->type,
            'status' => $requests->status,
            'price' => $requests->price,
        ]);

        Alert::success('Success', 'Paket Berhasil Di Update');
        return redirect()->route('admin.paket-kelas');
    }

    public function delete(Request $requests)
    {
        $id = $requests->query('id');

        $paket = CourseEbook::where('id', $id)->first();

        $paket->delete();
        Alert::success('Success', 'Paket Berhasil Di Delete');
        return redirect()->route('admin.paket-kelas');
    }
}
