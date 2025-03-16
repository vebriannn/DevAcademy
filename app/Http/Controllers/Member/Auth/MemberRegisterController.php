<?php

namespace App\Http\Controllers\Member\Auth;

use App\Http\Controllers\Controller;
use App\Models\Profession;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;

// model yang di butuhkan
use App\Models\User;


class MemberRegisterController extends Controller
{
    // Sesi pertama: Form registrasi akun (hanya nama, email, dan password)
    public function index()
    {
        $profession = Profession::all();
        return view('member.auth.register', compact('profession')); // Tampilan sesi pertama
    }

    public function store(Request $requests)
    {
        $requests->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'profession' => 'required',
            'password' => [
                'required',
                'string',
                'min:6',
            ]
        ]);

        // Set default avatar jika tidak ada file yang diunggah
        $avatar = 'default.png';

        if ($requests->hasFile('avatar')) {
            $getNameImageAvatar = $requests->file('avatar')->getClientOriginalName();
            $avatarName = Str::random(10) . '_' . $getNameImageAvatar;
            $avatar = $requests->file('avatar')->storeAs('public/images/avatars', $avatarName);
        }

        // Simpan user ke database
        $user = User::create([
            'avatar' => $avatar,
            'name' => $requests->name,
            'email' => $requests->email,
            'profession' => $requests->profession,
            'password' => Hash::make($requests->password),
        ]);

        // **Kirim event agar email verifikasi otomatis dikirim**
        event(new Registered($user));

        // **Langsung login user setelah registrasi**
        Auth::login($user);

        Alert::success('Success', 'Akun berhasil dibuat! Silakan verifikasi email Anda.');

        return redirect()->route('verification.notice');
    }
}
