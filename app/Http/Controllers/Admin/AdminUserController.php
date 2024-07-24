<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Illuminate\Support\Str;

class AdminUserController extends Controller
{
    public function index() {
        $users = User::all();
        // return response()->json($users);
        dd($users);
    }

    public function create() {
        // Return a view for creating users, if needed
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|string|in:students,mentor,superadmin',
        ]);

        $avatarPath = null;

        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $avatarName = Str::random(10) . '.' . $avatar->getClientOriginalExtension();
            $avatarPath = $avatar->storeAs('public/images/avatars', $avatarName);
        }

        User::create([
            'name' => $request->name,
            'avatar' => $avatarPath,
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
        ]);

        return response()->json([
            'message' => 'User created successfully'
        ], 201);
    }

    public function edit($id) {
        $user = User::findOrFail($id);
        return response()->json($user);
    }

    public function update(Request $request, $id) {
        $request->validate([
            'name' => 'required|string|max:255',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'username' => 'required|string|max:255|unique:users,username,' . $id,
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8',
            'role' => 'required|string|in:students,mentor,superadmin',
        ]);

        $user = User::findOrFail($id);
        $avatarPath = $user->avatar;

        if ($request->hasFile('avatar')) {
            if ($avatarPath) {
                Storage::disk('public')->delete($avatarPath);
            }
            
            $avatar = $request->file('avatar');
            $avatarName = Str::random(10) . '.' . $avatar->getClientOriginalExtension();
            $avatarPath = $avatar->storeAs('public/images/avatars', $avatarName);
        }

        $user->update([
            'name' => $request->name,
            'avatar' => $avatarPath,
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->password ? bcrypt($request->password) : $user->password,
            'role' => $request->role,
        ]);

        return response()->json([
            'message' => 'User updated successfully'
        ], 200);
    }

    public function delete($id) {
        $user = User::findOrFail($id);
        
        if ($user->avatar) {
            Storage::disk('public')->delete($user->avatar);
        }

        $user->delete();
        
        return response()->json([
            'message' => 'User deleted successfully'
        ], 200);
    }
}
