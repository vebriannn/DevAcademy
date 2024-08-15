<?php
namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class MemberSettingController extends Controller
{
    public function index(){
        return view('member.dashboard.setting.view');
    }

    public function editProfile(){
        return view('member.dashboard.setting.edit_profile');
    }

    public function editPassword(){
        return view('member.dashboard.setting.edit_password');
    }

    public function updateProfile(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'username' => 'required|string|max:255',
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $user = User::findOrFail(Auth::id()); 
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->username = $request->input('username');

        if ($request->hasFile('avatar')) {
            
            if ($user->avatar && Storage::exists('public/images/avatars/' . $user->avatar)) {
                Storage::delete('public/images/avatars/' . $user->avatar);
            }

            $avatar = $request->file('avatar')->store('images/avatars', 'public');
            $user->avatar = basename($avatar);
        }

        $user->save();

        return redirect()->route('member.setting')->with('success', 'Profile updated successfully.');
    }

    public function updatePassword(Request $request){
        $request->validate([
            'old_password' => 'required|string',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::findOrFail(Auth::id()); 
        if (!Hash::check($request->input('old_password'), $user->password)) {
            return redirect()->route('member.edit-password')
            ->withErrors(['old_password' => 'The old password is incorrect.'])
            ->withInput();
        }

        $user->password = $request->input('new_password');
        $user->save();

        return redirect()->route('member.setting')->with('success', 'Password updated successfully.');
    }
}