<?php

namespace App\Http\Controllers\Admin\Sdm;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;


use App\Models\User;
use App\Models\Profession;
use App\Models\Course;

class AdminMentorController extends Controller
{
    public function index(Request $request)
    {
        $mentors = User::where('role', 'mentor')->with('courses')->get();
        return view('admin.sdm.mentor.view', compact('mentors'));
    }

    public function create()
    {
        $professions = Profession::all(); // Ambil semua profesi dari tabel professions
        return view('admin.sdm.mentor.create', compact('professions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'profession' => 'required|string|max:255',
            'password' => 'required|string|min:6',
        ]);

        User::create([
            'avatar' => 'default.png',
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'mentor',
            'profession' => $request->profession,
        ]);


        return redirect()->route('admin.mentor')->with('success', 'Mentor berhasil ditambahkan.');
    }

    public function edit(Request $requests, $id)
    {
        $mentor =  User::where('id', $id)->first();
        $professions = Profession::all(); // Pastikan model Profession sudah ada
        return view('admin.sdm.mentor.update', compact('mentor', 'professions'));
    }

    public function update(Request $request, $id)
    {
        $mentor = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $mentor->id,
            'role' => 'required|string|in:mentor,superadmin',
            'profession' => 'required|string|max:255',
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $mentor->update([
            'name' => $request->name,
            'username' => $request->name,
            'email' => $request->email,
            'profession' => $request->profession,
            'role' => $request->role,
            'password' => $request->filled('password') ? Hash::make($request->password) : $mentor->password,
        ]);

        return redirect()->route('admin.mentor')->with('success', 'Mentor berhasil diubah.');
    }

    public function delete(Request $requests, $id)
    {
        $mentor =  User::where('id', $id)->first();

        if ($mentor->avatar && $mentor->avatar !== 'default.png') {
            $avatarPath = 'public/images/avatars/' . $mentor->avatar;
            if (Storage::exists($avatarPath)) {
                Storage::delete($avatarPath);
            }
        }

        $mentor->delete();

        return redirect()->route('admin.mentor')->with('success', 'Mentor berhasil dihapus.');
    }
}
