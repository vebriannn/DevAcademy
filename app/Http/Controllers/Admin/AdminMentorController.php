<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminMentorController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->get('entries', 10);
        $mentors = User::where('role', 'mentor')->paginate($perPage);
        return view('admin.mentor.view', [
            'mentors' => $mentors
        ]);
    }

    public function create()
    {
        return view('admin.mentor.create');
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

    public function edit($id)
    {
        $mentor = User::findOrFail($id);
        return view('admin.mentor.edit', compact('mentor'));
    }

    public function update(Request $request, $id)
    {
        $mentor = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $mentor->id,
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $mentor->name = $request->input('name');
        $mentor->email = $request->input('email');

        if ($request->filled('password')) {
            $mentor->password = Hash::make($request->input('password'));
        }

        $mentor->save();

        return redirect()->route('admin.mentor')->with('success', 'Mentor updated successfully.');
    }

    public function destroy($id)
    {
        $mentor = User::findOrFail($id);

        if ($mentor->avatar) {
            $avatarPath = 'public/images/avatars/' . $mentor->avatar;
            
            if (Storage::exists($avatarPath)) {
                if (Storage::delete($avatarPath)) {
                    $message = 'mentor and avatar deleted successfully';
                } else {
                    return response()->json([
                        'message' => 'Failed to delete avatar'
                    ], 500);
                }
            } else {
                $message = 'mentor deleted successfully, but avatar does not exist';
            }
        } else {
            $message = 'mentor deleted successfully';
        }
    
        $mentor->delete();
        return response()->json([
            'message' => $message
        ], 200);

        // return redirect()->route('admin.mentor')->with('success', 'Mentor deleted successfully.');
    }
}
