<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminSuperadminController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->get('entries', 10);
        $superadmins = User::where('role', 'superadmin')->paginate($perPage);
        return view('admin.superadmin.view', [
            'superadmins' => $superadmins
        ]);
    }

    public function create()
    {
        return view('admin.superadmin.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'superadmin', 
        ]);

        return redirect()->route('admin.superadmin')->with('success', 'Super Admin created successfully.');
    }

    public function edit($id)
    {
        $superadmin = User::findOrFail($id);
        return view('admin.superadmin.edit', compact('superadmin'));
    }

    public function update(Request $request, $id)
    {
        $superadmin = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $superadmin->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $superadmin->name = $request->input('name');
        $superadmin->email = $request->input('email');

        if ($request->filled('password')) {
            $superadmin->password = Hash::make($request->input('password'));
        }

        $superadmin->save();

        return redirect()->route('admin.superadmin')->with('success', 'Super Admin updated successfully.');
    }

    public function destroy($id)
    {
        $superadmin = User::findOrFail($id);
        
        if ($superadmin->avatar) {
            $avatarPath = 'public/images/avatars/' . $superadmin->avatar;
            
            if (Storage::exists($avatarPath)) {
                if (Storage::delete($avatarPath)) {
                    $message = 'superadmin and avatar deleted successfully';
                } else {
                    return response()->json([
                        'message' => 'Failed to delete avatar'
                    ], 500);
                }
            } else {
                $message = 'superadmin deleted successfully, but avatar does not exist';
            }
        } else {
            $message = 'superadmin deleted successfully';
        }
    
        $superadmin->delete();
        return response()->json([
            'message' => $message
        ], 200);

        // return redirect()->route('admin.superadmin')->with('success', 'Super Admin deleted successfully.');
    }
}
