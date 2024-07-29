<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Exception;

class AdminUserController extends Controller
{
    public function index() {
        $users = User::all();
        return response()->json([
            'message' => 'Data retrieved successfully',
            'data' => $users
        ], 200);
    }

    public function create() {
    }

    public function store(Request $request) {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                'username' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email',
                'password' => 'required|string|min:8',
                'role' => 'required|string|in:students,mentor,superadmin',
            ]);

            $avatarPath = null;
            if ($request->hasFile('avatar')) {
                $avatar = $request->file('avatar');
                $avatarName = Str::random(10) . '.' . $avatar->getClientOriginalExtension();
                $avatarPath = $avatar->storeAs('public/images/avatars', $avatarName);
            }

            $user = User::create([
                'name' => $request->name,
                'avatar' => $avatarPath,
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role,
            ]);

            return response()->json([
                'message' => 'User created successfully',
                'data' => $user
            ], 201);

        } catch (Exception $e) {
            return response()->json([
                'message' => 'Failed to create user',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function edit($id) {
        $user = User::findOrFail($id);
        return response()->json([
            'message' => 'Data retrieved successfully',
            'data' => $user
        ], 200);
    }

    public function update(Request $request, $id) {
        try {
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
                if ($avatarPath && Storage::exists($avatarPath)) {
                    Storage::delete($avatarPath);
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
                'password' => $request->filled('password') ? Hash::make($request->password) : $user->password,
                'role' => $request->role,
            ]);

            return response()->json([
                'message' => 'User updated successfully'
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                'message' => 'Failed to update user',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function delete($id) {
        try {
            $user = User::findOrFail($id);
            if ($user->avatar && Storage::exists($user->avatar)) {
                Storage::delete($user->avatar);
            }
            $user->delete();

            return response()->json([
                'message' => 'User deleted successfully'
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                'message' => 'Failed to delete user',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
