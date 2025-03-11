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
        if (Auth::check()) {
            if (Auth::user()->role != 'students') {
                return redirect()->route('admin.course');
            }
            return redirect()->route('home');
        }
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::check()) {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }

        // Retrieve user by email
        $user = User::where('email', $request->email)->first();

        if ($user) {
            if (Auth::attempt($request->only('email', 'password'))) {
                $request->session()->regenerate();

                if ($user->role === 'students') {
                    Alert::error('Error', 'Maaf Anda Tidak Memiliki Akses Untuk Halaman Ini!');
                    return redirect()->route('home');
                }
                return redirect()->route('admin.course')->with('success', 'Anda berhasil login');
            } else {
                return redirect()
                    ->back()
                    ->withErrors(['password' => 'Incorrect password.'])
                    ->withInput();
            }
        } else {
            return redirect()
                ->back()
                ->withErrors(['email' => 'Email not registered.'])
                ->withInput();
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')->with('success', 'Anda telah logout');
    }
}
