<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;

use App\Models\Course;
use App\Models\CourseEbook;
use App\Models\Ebook;
use App\Models\User;


class AdminCourseEbookController extends Controller
{
    public function index(Request $requests)
    {
        $paketKelas = CourseEbook::with(['course', 'ebook'])->get();
        $users = null;
        if ($paketKelas->isNotEmpty() && $paketKelas->first()->course) {
            $users = User::where('id', $paketKelas->first()->course->mentor_id)->first();
        }
        return view('admin.paket-kelas.view', compact('paketKelas', 'users'));
    }


    public function create()
    {
        $courses = Course::where('mentor_id', Auth::user()->id)
            ->where('status', 'published')
            ->whereDoesntHave('courseEbooks')
            ->get();
        $ebooks = Ebook::where('mentor_id', Auth::user()->id)
            ->where('status', 'published')
            ->whereDoesntHave('courseEbooks')
            ->get();
        return view('admin.paket-kelas.create', compact('courses', 'ebooks'));
    }


    public function store(Request $requests)
    {
        $requests->validate([
            'name_course' => 'required',
            'name_ebook' => 'required',
            'price' => 'required|numeric|min:0',
            'type' => 'required|in:free,premium',
        ]);

        $course = Course::where('name', $requests->name_course)->first();
        $ebook = Ebook::where('name', $requests->name_ebook)->first();

        CourseEbook::create([
            'course_id' => $course->id,
            'ebook_id' => $ebook->id,
            'type' => $requests->type,
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
        $courses = Course::where('mentor_id', Auth::user()->id)
            ->where('status', 'published')
            ->whereDoesntHave('courseEbooks')
            ->get();
        $ebooks = Ebook::where('mentor_id', Auth::user()->id)
            ->where('status', 'published')
            ->whereDoesntHave('courseEbooks')
            ->get();
        return view('admin.paket-kelas.update', compact('courses', 'ebooks', 'paketKelas'));
    }

    public function update(Request $requests, $id)
    {
        $requests->validate([
            'name_course' => 'required|max:60',
            'name_ebook' => 'required|max:60',
            'price' => 'required|numeric|min:0',
            'type' => 'required|in:free,premium',
        ]);


        $courseEbook = CourseEbook::where('id', $id)->first();

        $course = Course::where('name', $requests->name_course)->first();
        $ebook = Ebook::where('name', $requests->name_ebook)->first();

        $harga = ($course->price + $ebook->price) * 0.8;

        $courseEbook->update([
            'course_id' => $course->id,
            'ebook_id' => $ebook->id,
            'type' => $requests->type,
            // 'status' => $requests->status,
            'price' => $harga,
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
