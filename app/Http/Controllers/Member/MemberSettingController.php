<?php
namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\User;

class MemberSettingController extends Controller
{
    public function index(){
        return view('member.dashboard.setting.view');
    }

    public function editProfile(){
        return view('member.dashboard.setting.edit_profile');
    }
    public function editEmail(){
        return view('member.dashboard.setting.edit_email');
    }
    public function editPassword(){
        return view('member.dashboard.setting.edit_password');
    }
    public function updateEmail(Request $request) {
        $request->validate([
            'new_email' => 'required|email|unique:users,email|max:255',
        ]);
    
        $user = User::findOrFail(Auth::id());
        $user->email = $request->input('new_email');
        $user->save();
    
        Alert::success('Email Berhasil Diupdate');
        return redirect()->route('member.setting');
    }
    
    public function updateProfile(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'profession' => 'required|string|max:255',
        ]);

        $user = User::findOrFail(Auth::id()); 
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->profession = $request->input('profession');

        if ($request->hasFile('avatar')) {
            
            if ($user->avatar && Storage::exists('public/images/avatars/' . $user->avatar)) {
                Storage::delete('public/images/avatars/' . $user->avatar);
            }

            $avatar = $request->file('avatar')->store('images/avatars', 'public');
            $user->avatar = basename($avatar);
        }

        $user->save();

        Alert::success('Profile Berhasil Di Update');
        return redirect()->route('member.setting');
    }

    public function updatePassword(Request $request) {
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
    
        $user->password = Hash::make($request->input('new_password'));
        $user->save();
    
        Alert::success('Password Berhasil Di Update');
        return redirect()->route('member.setting');
    }
    
}