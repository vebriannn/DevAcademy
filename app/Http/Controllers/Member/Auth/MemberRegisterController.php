<?php

namespace App\Http\Controllers\Member\Auth;

use App\Http\Controllers\Controller;
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
        return view('member.auth.register'); // Tampilan sesi pertama
    }

    public function store(Request $requests)
    {
        // Validasi input sesi pertama (nama, email, password)

        $requests->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'profession' => 'required',
            'password' => [
                'required',
                'string',
                'min:8',
                'regex:/[a-z]/',
                'regex:/[0-9]/',
            ],
        ], [
            'password.regex' => 'Password harus berisi kombinasi huruf dan angka',
        ]);

        $avatar = null;

        if ($requests->hasFile('avatar')) {
            $requests->validate([
                'avatar' => 'image|mimes:jpg,jpeg,png,svg|max:2048', // Validasi hanya jika ada file
            ]);

            $getNameImageAvatar = $requests->avatar->getClientOriginalName();
            $avatar = Str::random(10) . $getNameImageAvatar;
            // simpan avatar ke storage
            $requests->avatar->storeAs('public/images/avatars', $avatar);
        }

        try {
            $user = User::create([
                'avatar' => $avatar,
                'name' => $requests->name,
                'email' => $requests->email,
                'profession' => $requests->profession,
                'password' => Hash::make($requests->password)
            ]);

            event(new Registered($user));
            Auth::login($user);
            return redirect()->route('verification.notice');

        } catch (\Exception $error) {
            Alert::error('Error Server', 'Maaf Terjadi Error, Mohon Coba Lagi Beberapa Saat ');
            return redirect()->back();
        }
    }


    public function storeProfile(Request $requests)
    {
        // Validasi input sesi kedua (profesi dan avatar)
        $requests->validate([
            'profession' => 'required|string|max:255',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg',
        ]);
        $registerData = $requests->session()->get('register_data');
        if (!$registerData) {
            return redirect()->route('register')->withErrors(['error' => 'Sesi pendaftaran telah habis, silahkan ulangi.']);
        }
        $imagesGetNewName = 'default.png';
        if ($requests->hasFile('avatar')) {
            $images = $requests->file('avatar');
            $imagesGetNewName = Str::random(10) . $images->getClientOriginalName();
            $images->storeAs('public/images/avatars', $imagesGetNewName);
        }
        // Buat user baru dengan data dari kedua sesi
        $user = User::create([
            'name' => $registerData['name'],
            'email' => $registerData['email'],
            'password' => $registerData['password'],
            'profession' => $requests->profession,
            'avatar' => $imagesGetNewName,
            'role' => 'students',
        ]);

        auth()->login($user);
        Alert::success('Success', 'Register Berhasil');
        return redirect()->route('home');
    }
}
