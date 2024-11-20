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
        $user = Auth::user();
        if ($user->role === 'superadmin') {
            $courses = Course::with('users')->where('status', 'published')->whereDoesntHave('courseEbooks')->OrderBy('id', 'DESC')->get();
            $ebooks = Ebook::with('users')->where('status', 'published')->whereDoesntHave('courseEbooks')->orderBy('id', 'DESC')->get();
        } else {
            $courses = Course::where('mentor_id', Auth::user()->id)
                ->where('status', 'published')
                ->whereDoesntHave('courseEbooks')
                ->get();
            $ebooks = Ebook::where('mentor_id', Auth::user()->id)
                ->where('status', 'published')
                ->whereDoesntHave('courseEbooks')
                ->get();
        }
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
        $harga = $requests->type === 'premium' 
        ? ($course->price + $ebook->price) * 0.8 
        : 0;

        CourseEbook::create([
            'course_id' => $course->id,
            'ebook_id' => $ebook->id,
            'type' => $requests->type,
            'price' =>  $harga,
            'mentor_id' => Auth::user()->id
        ]);

        Alert::success('Success', 'Paket Berhasil Di Buat');
        return redirect()->route('admin.paket-kelas');
    }


    public function edit(Request $requests)
    {
        $id = $requests->query('id');
        $paketKelas = CourseEbook::with(['course', 'ebook'])->where('id', $id)->first();
        $user = Auth::user();
        if ($user->role === 'superadmin') {
            $courses = Course::with('users')->where('status', 'published')->OrderBy('id', 'DESC')->get();
            $ebooks = Ebook::with('users')->where('status', 'published')->orderBy('id', 'DESC')->get();
        } else {
            $courses = Course::where('mentor_id', Auth::user()->id)
                ->where('status', 'published')
                ->get();
            $ebooks = Ebook::where('mentor_id', Auth::user()->id)
                ->where('status', 'published')
                ->get();
        }
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
        $courseEbook = CourseEbook::where('id', $id)->firstOrFail();
        $course = Course::where('name', $requests->name_course)->firstOrFail();
        $ebook = Ebook::where('name', $requests->name_ebook)->firstOrFail();
        $harga = $requests->type === 'premium' 
            ? ($course->price + $ebook->price) * 0.8 
            : 0;
        $courseEbook->update([
            'course_id' => $course->id,
            'ebook_id' => $ebook->id,
            'type' => $requests->type,
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
