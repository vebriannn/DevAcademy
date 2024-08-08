<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class AdminStudentController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->get('entries', 10);
        $students = User::where('role', 'students')->paginate($perPage);
        return view('admin.member.data-member', [
            'students' => $students
        ]);
    }
    

    public function create()
    {
        return view('admin.member.create-data-member');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'role' => 'students',
        ]);

        return redirect()->route('admin.member')->with('success', 'Member created successfully.');
    }
}
