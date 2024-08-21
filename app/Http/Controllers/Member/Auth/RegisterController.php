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

        $imagesGetNewName = null;
        if($request->hasFile('avatar')) {
            $images = $request->file('avatar');
            $imagesGetNewName = Str::random(10).$images->getClientOriginalName();
            $images->storeAs('public/images/avatars', $imagesGetNewName);
        }

        $email = $request->input('email');
        $password = $request->input('password');
        
        // Cek apakah email sudah ada
        $cekEmail = User::where('email', $email)->first();
        if (!$cekEmail) {
            $user = User::create([
                'name' => $request->input('name'),
                'username' => $request->input('name'),
                'email' => $email,
                'password' => bcrypt($password),
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
