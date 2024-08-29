<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
<<<<<<< HEAD
use RealRashid\SweetAlert\Facades\Alert;

=======
>>>>>>> 362969dd865601912ea1f548072f14c2e8ecd27f
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

<<<<<<< HEAD
        // Cek apakah email ada di database
        $user = User::where('email', $request->email)->first();
        $credentials = $request->only('email', 'password');

        if ($user) {
            // Jika email ada, periksa password
            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                Alert::success('Success', 'Login Berhasil');
                return redirect()->route('admin.course');
=======
        if (Auth::check()) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }
        $user = User::where('email', $request->email)->first();

        if ($user) {
            $credentials = $request->only('email', 'password');
            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                if ($user->role === 'students') {
                    return redirect()->route('home')->with('error', 'You do not have access');
                }

                return redirect()->route('admin.course')->with('success', 'Login successful.');
>>>>>>> 362969dd865601912ea1f548072f14c2e8ecd27f
            } else {
                return redirect()->back()->withErrors(['password' => 'Password salah.'])->withInput();
            }
        } else {
            return redirect()->back()->withErrors(['email' => 'Email tidak terdaftar.'])->withInput();
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        Alert::success('Success', 'Logout Berhasil');
        return redirect()->route('admin.login');
    }
}
