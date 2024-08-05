<?php

namespace App\Http\Controllers\Member\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log; // Import Log facade
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

        // JANGAN DIGUNAKAN DI PRODUCTION
        // Log::info('Login attempt:', [
        //     'email' => $email,
        //     'password' => $password
        // ]);

        // Cek apakah email ada di database
        $user = User::where('email', $email)->first();

        if ($user) {
            // Log user ditemukan
            // Log::info('User ditemukan:', ['user' => $user]);

            // Jika email ada, periksa password
            if (Auth::attempt(['email' => $email, 'password' => $password])) {
                $request->session()->regenerate();
                // Log::info('Login berhasil untuk email: ' . $email);
                return redirect()->route('home')->with('success', 'Login successful.');
            } else {
                // Log::warning('Login gagal: Password salah untuk email: ' . $email);
                return redirect()->back()->withErrors(['password' => 'Password salah.'])->withInput();
            }
        } else {
            // Log::warning('Login gagal: Email tidak ditemukan: ' . $email);
            return redirect()->back()->withErrors(['email' => 'Email tidak terdaftar.'])->withInput();
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        // Log::info('Logout Berhasil ');
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home');
    }
}
