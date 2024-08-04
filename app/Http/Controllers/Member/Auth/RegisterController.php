<?php

namespace App\Http\Controllers\Member\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Log;

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

        // JANGAN DIGUNAKAN DI PROFUCTION
        // Log::info('Password sebelum di-hash: ' . $request->input('password'));

        // Upload avatar dengan nama acak dan ekstensi asli
        $avatarPath = 'default.png';
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $getName = $avatar->getClientOriginalName();
            $avatarName = Str::random(9) . '.' . $avatar->getClientOriginalExtension();
            $avatar->storeAs('public/images/avatars', $avatarName);
            $avatarPath = $avatarName;
        }

        $email = $request->input('email');
        $password = $request->input('password');

        // Log email dan password untuk debugging
        // Log::info('Registrasi dengan email: ' . $email);

        // Cek apakah email sudah ada
        $cekEmail = User::where('email', $email)->first();
        if (!$cekEmail) {
            // Buat pengguna baru
            $user = User::create([
                'name' => $request->input('name'),
                'username' => $request->input('name'),
                'email' => $email,
                'password' => $password,
                'avatar' => $avatarPath,
                'role' => 'students',
            ]);

            // Log::info('User baru dibuat: ', ['user' => $user]);

            auth()->login($user);

            // Redirect ke halaman yang diinginkan
            return redirect()->route('home')->with('success', 'Registration successful.');
        } else {
            // Log::warning('Email sudah terdaftar: ' . $email);
            return redirect()->back()->withErrors(['email' => 'Email sudah terdaftar, silahkan gunakan akun lain'])->withInput();
        }
    }
}
