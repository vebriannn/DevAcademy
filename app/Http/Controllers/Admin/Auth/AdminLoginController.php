<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

use App\Models\User;

class AdminLoginController extends Controller
{
    public function index()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Cek apakah email ada di database
        $user = User::where('email', $request->email)->first();
        $credentials = $request->only('email', 'password');

        if ($user) {
            // Jika email ada, periksa password
            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                Alert::success('Success', 'Login Berhasil');
                return redirect()->route('admin.course');
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
        Alert::success('Success', 'Logout Berhasil');
        return redirect()->route('admin.login');
    }
}