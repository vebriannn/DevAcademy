<?php

namespace App\Http\Controllers\member\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Auth;
use App\Notifications\CustomResetPasswordNotification; // Import yang benar


// models users
use App\Models\User;
use RealRashid\SweetAlert\Facades\Alert;

class forgotPassController extends Controller
{

    public function index()
    {
        return view('member.auth.forget-pass');
    }

    public function checkEmail(Request $requests)
    {
        $requests->validate(
            [
                'email' => 'required|email'
            ]
        );

        // Kirimkan link reset password
        $status = Password::sendResetLink($requests->only('email'), function ($user, $token) {
            $user->notify(new CustomResetPasswordNotification($token));
        });

        $statusSend = 'limit';

        if ($status === Password::RESET_LINK_SENT) {
            RateLimiter::hit('reset-password:' . $requests->email, 3600);
            $statusSend = 'success';
            Alert::success('Berhasil', 'Link Reset Password Berhasil Di Kirim Ke Email Anda.');
            return redirect()->back();
        }


        return back()->withErrors(['email' => __($status)]);
    }

    public function sendResetLinkPassword(Request $requests, $token)
    {
        return view('member.auth.change-pass', [
            'token' => $token,
            'email' => $requests->query('email') // Gets the email from the query string
        ]);
    }

    public function resetPassword(Request $requests)
    {
        $requests->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => [
                'required',
                'string',
                'min:8',
            ]
        ]);

        $status = Password::reset(
            $requests->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ]);
                $user->save();
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            return redirect()->route('member.login')->with('success', 'Password Berhasl Di Reset');
        }

        Alert::error('Error', 'Maaf Terjadi Kesalahan Dalam Reset Password, SIlahkan Coba Lagi Dalam Beberapa Saat');
        return back();
    }
}
