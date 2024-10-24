<?php
namespace App\Http\Controllers\Member\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

use App\Models\User;

class MemberRegisterController extends Controller
{
    // Sesi pertama: Form registrasi akun (hanya nama, email, dan password)
    public function index() {
        return view('member.auth.register'); // Tampilan sesi pertama
    }

    public function store(Request $requests) {
        // Validasi input sesi pertama (nama, email, password)
        $requests->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
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
        // Simpan data sementara di session
        $requests->session()->put('register_data', [
            'name' => $requests->name,
            'email' => $requests->email,
            'password' => Hash::make($requests->password),
        ]);

        return redirect()->route('member.register.profile');
    }
    public function profileForm() {
        return view('member.auth.profile'); 
    }

    public function storeProfile(Request $requests) {
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
        if($requests->hasFile('avatar')) {
            $images = $requests->file('avatar');
            $imagesGetNewName = Str::random(10).$images->getClientOriginalName();
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
