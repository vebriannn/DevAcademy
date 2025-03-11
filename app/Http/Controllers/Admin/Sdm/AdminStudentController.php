<?php

namespace App\Http\Controllers\Admin\Sdm;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use App\Models\CompleteEpisodeCourse;
use App\Models\MyListCourse;
use App\Models\Transaction;
use App\Models\Profession;

class AdminStudentController extends Controller
{
    public function index(Request $request)
    {
        $students = User::where('role', 'students')->orderBy('created_at', 'desc')->get();
        return view('admin.sdm.students.view', compact('students'));
    }

    public function create()
    {
        $professions = Profession::all(); // Ambil semua profesi dari tabel professions
        return view('admin.sdm.students.create', compact('professions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8',
            'profession' => 'required|string|exists:tbl_professions,name', // Validasi profession harus ada di tabel professions
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            // 'email_verified_at' => now()->format('Y-m-d H:i:s'), // Format: 2025-03-10 03:07:17
            'password' => Hash::make($request->password),
            'role' => 'students',
            'profession' => $request->profession,
        ]);

        return redirect()->route('admin.students')->with('success', 'Students berhasil ditambahkan.');
    }

    public function edit(Request $request, $id)
    {
        $student = User::where('id', $id)->first();
        $professions = Profession::all(); // Pastikan model Profession sudah ada
        return view('admin.sdm.students.update', compact('student', 'professions'));
    }


    public function update(Request $request, $id)
    {
        $student =  User::where('id', $id)->first();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $student->id,
            'password' => 'nullable|string|min:8',
            'profession' => 'nullable|string|max:255|exists:tbl_professions,name',
        ]);

        $student->update([
            'name' => $request->name,
            'email' => $request->email,
            'profession' => $request->profession,
            'password' => $request->filled('password') ? Hash::make($request->password) : $student->password,
        ]);

        return redirect()->route('admin.students')->with('success', 'Students berhasil diubah');
    }

    public function delete($id)
    {
        $student = User::where('id', $id)->first();

        if ($student && !is_null($student->avatar) && $student->avatar !== 'default.png') {
            $avatarPath = 'public/images/avatars/' . $student->avatar;
            if (Storage::exists($avatarPath)) {
                Storage::delete($avatarPath);
            }
        }

        Transaction::where('id', $student->id)->delete();
        MyListCourse::where('user_id', $student->id)->delete();
        CompleteEpisodeCourse::where('user_id', $student->id)->delete();
        $student->delete();

        return redirect()->route('admin.students')->with('success', 'Students berhasil dihapus');
    }
}
