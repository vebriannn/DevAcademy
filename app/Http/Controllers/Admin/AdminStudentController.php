<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\User;

class AdminStudentController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->get('entries', 10);
        $students = User::where('role', 'students')->paginate($perPage);
        return view('admin.member.view', compact('students'));
    }

    public function create()
    {
        return view('admin.member.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'profession' => 'required|string|max:255',
        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->name,
            'avatar' => 'default.png',
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'students',
            'profession' => $request->profession,
        ]);

        Alert::success('Success', 'Data Member Berhasil Dibuat');
        return redirect()->route('admin.member.index');
    }

    public function edit($id)
    {
        $student = User::findOrFail($id);
        return view('admin.member.edit', compact('student'));
    }

    public function update(Request $request, $id)
    {
        $student = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $student->id,
            'password' => 'nullable|string|min:8|confirmed',
            'profession' => 'nullable|string|max:255',
        ]);

        $student->update([
            'name' => $request->name,
            'username' => $request->name,
            'email' => $request->email,
            'profession' => $request->profession,
            'password' => $request->filled('password') ? Hash::make($request->password) : $student->password,
        ]);

        Alert::success('Success', 'Data Member Berhasil Diupdate');
        return redirect()->route('admin.member.index');
    }

    public function destroy($id)
    {
        $student = User::findOrFail($id);

        if ($student->avatar && $student->avatar !== 'default.png') {
            $avatarPath = 'public/images/avatars/' . $student->avatar;
            if (Storage::exists($avatarPath)) {
                Storage::delete($avatarPath);
            }
        }

        $student->delete();

        Alert::success('Success', 'Data Member Berhasil Dihapus');
        return redirect()->route('admin.member.index');
    }
}
