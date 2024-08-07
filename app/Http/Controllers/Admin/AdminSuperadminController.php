<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminSuperadminController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->get('entries', 10);
        $superadmins = User::where('role', 'superadmin')->paginate($perPage);
        return view('admin.datasuperadmin.data-superadmin', [
            'superadmins' => $superadmins
        ]);
    }

    public function create()
    {
        return view('admin.datasuperadmin.create-data-superadmin');
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
}
