<?php

namespace App\Http\Controllers\Member\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class MemberRegisterController extends Controller
{
    public function index() {
        return view('member.auth.register');
    }

    public function store(Request $requests) {
          // Validasi input tanpa konfirmasi password
        $requests->validate([
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

        $imagesGetNewName = 'default.png';
        if($requests->hasFile('avatar')) {
            $images = $requests->file('avatar');
            $imagesGetNewName = Str::random(10).$images->getClientOriginalName();
            $images->storeAs('public/images/avatars', $imagesGetNewName);
        }

        // Cek apakah email sudah ada
        $cekEmail = User::where('email', $requests->email)->first();
        if (!$cekEmail) {
            
            $user = User::create([
                'name' => $requests->name,
                'username' => $requests->name,
                'email' => $requests->email,
                'password' => Hash::make($requests->password),
                'avatar' => $imagesGetNewName,
                'role' => 'students',
            ]);

            auth()->login($user);
            return redirect()->route('home')->with('success', 'Registration successful.');
        } else {
            // Log::warning('Email sudah terdaftar: ' . $email);
            return redirect()->back()->withErrors(['email' => 'Email sudah terdaftar, silahkan gunakan akun lain'])->withInput();
        }
    }
}