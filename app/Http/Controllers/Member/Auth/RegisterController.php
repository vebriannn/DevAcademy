<?php

namespace App\Http\Controllers\Member\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class RegisterController extends Controller
{
    public function index()
    {
        return view('member.auth.register');
    }

    public function register(Request $request)
    {
        // Validasi input tanpa konfirmasi password
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => [
                'required',
                'string',
                'min:8',
                'regex:/[a-z]/',
                'regex:/[0-9]/', 
            ],
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'password.regex' => 'Password harus berisi kombinasi huruf dan angka',
        ]);

        // Upload avatar dengan nama acak dan ekstensi asli
        $avatarPath = null;
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $extension = $avatar->getClientOriginalExtension(); 
            $avatarName = Str::random(9) . '.' . $extension; 
            $avatar->storeAs('public/images/avatars', $avatarName);
            $avatarPath = $avatarName;
        }

        // Buat pengguna baru
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'avatar' => $avatarPath,
            'role' => 'students',
        ]);

        // Login pengguna setelah registrasi
        auth()->login($user);

        // Redirect ke halaman yang diinginkan
        return redirect()->route('/')->with('success', 'Registration successful.');
    }
}
