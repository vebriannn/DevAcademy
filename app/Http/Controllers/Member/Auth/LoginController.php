<?php

namespace App\Http\Controllers\Member\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{
    public function index()
    {
        return view('member.auth.login');
    }

    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $email = $request->input('email');
        $password = $request->input('password');
        
        // Cek apakah email ada di database
        $user = User::where('email', $email)->first();

        if ($user) {
            // Jika email ada, periksa password
            if (Hash::check($password, $user->password)) {
                // Autentikasi berhasil
                Auth::login($user);
                return redirect()->intended('/')->with('success', 'Login successful.');
            } else {
                // Password salah
                return redirect()->back()->withErrors(['password' => 'Password salah.'])->withInput();
            }
        } else {
            // Email tidak ditemukan
            return redirect()->back()->withErrors(['email' => 'Email tidak terdaftar.'])->withInput();
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('/');
    }
}
