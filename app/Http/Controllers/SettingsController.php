<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function profile()
    {
        return view('settings.profile');
    }

    public function editProfile()
    {
        return view('settings.edit-profile');
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email,' .$user->id
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return redirect()->route('profile')->with('flash_notification', [
            'level' => 'success',
            'message' => 'Berhasil merubah data profile'
        ]);
    }

    public function editPassword()
    {
        return view('settings.edit-password');
    }

    public function updatePassword(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'password' => 'required',
            'new_password' => 'required|confirmed|min:6',
        ]);

        if (!Hash::check($request->password, $user->password)) {
            return redirect()->back()->with('flash_notification', [
                'level' => 'danger',
                'message' => 'Password lama salah'
            ]);
        }

        $user->password = bcrypt($request->new_password);
        $user->save();

        return redirect()->route('password.edit')->with('flash_notification', [
            'level' => 'success',
            'message' => 'Berhasil memperbarui password'
        ]);
    }
}
