<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminMentorController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->get('entries', 10);
        $mentors = User::where('role', 'mentor')->paginate($perPage);
        return view('admin.mentor.data-mentor', [
            'mentors' => $mentors
        ]);
    }

    public function create()
    {
        return view('admin.mentor.create-data-mentor');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'role' => 'mentor',
        ]);

        return redirect()->route('admin.mentor')->with('success', 'Mentor created successfully.');
    }
}
