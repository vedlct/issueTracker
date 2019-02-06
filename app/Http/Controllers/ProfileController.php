<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Auth;
use Session;
use Hash;

class ProfileController extends Controller
{
    public function profile()
    {
        return view('Profile.profile');
    }

    public function updateProfile(Request $r)
    {

        if($r->password1)
        {
            $r->validate([
                'password1' => 'required|same:password2'
            ]);
        }

        $user = User::where('userId', Auth::user()->userId)->first();
        $user->fullName = $r->fullname;
        $user->email = $r->email;
        $user->userPhoneNumber = $r->phone;

        if($r->password1)
        {
            $user->password = Hash::make($r->password1);
        }

        $user->save();

        if ($r->hasFile('profileImage')) {
            $file = $r->file('profileImage');
            $fileName = Auth::user()->userId . "." . $file->getClientOriginalExtension();
            $destinationPath = public_path('files/profileImage');
            $file->move($destinationPath, $fileName);
            $user->profilePhoto=$fileName;
            $user->save();
        }


        Session::flash('message', 'Profile Updated!');

        return back();
    }
}
