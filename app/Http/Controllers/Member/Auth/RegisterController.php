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
            'email' => 'required|email',
            'password' => [
                'required',
                'string',
                'min:8',
                'regex:/[a-z]/',
                'regex:/[0-9]/', 
            ],
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg',
        ], [
            'password.regex' => 'Password harus berisi kombinasi huruf dan angka',
        ]);

        // Upload avatar dengan nama acak dan ekstensi asli
        $avatarPath = 'default.png';
        if ($request->avatar) {
            $avatar = $request->avatar;
            $getName = $avatar->getClientOriginalName();
            $avatarName = Str::random(9).$getName; 
            $avatar->storeAs('public/images/avatars/'.$avatarName);
            $avatarPath = $avatarName;
        }

        $cekEmail = User::where('email', $request->email)->first();
        if(!$cekEmail) {
            // Buat pengguna baru
            $user = User::create([
                'name' => $request->input('name'),
                'username' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
                'avatar' => $avatarPath,
                'role' => 'students',
            ]);
            auth()->login($user);
    
            // Redirect ke halaman yang diinginkan
            return redirect()->route('home')->with('success', 'Registration successful.');
        }
        else {
            return redirect()->back()->withErrors(['email' => 'Email sudah terdaftar, silahakan gunakan akun lain'])->withInput();
        }
        
    }
}