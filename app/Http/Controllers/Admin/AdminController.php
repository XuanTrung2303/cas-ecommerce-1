<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //admin after login
    public function admin()
    {
        return view('admin.home');
    }

    //admin custom logout
    public function logout()
    {
        Auth::logout();
        $notification = array('messege' => 'You are logged out!', 'alert-type' => 'success');

        return redirect()->route('admin.login')->with($notification);
    }

    // change password page
    public function PasswordChange()
    {
        return view('admin.profile.change_password');
    }

    // password update
    public function PasswordUpdate(Request $request)
    {
        $validated = $request->validate([
            'old_password' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);

        $current_password = Auth::user()->password;    //login user password get

        $old_pass = $request->old_password;  //old_password get from input field
        $new_password = $request->password; //new_password get for new password
        if (Hash::check($old_pass, $current_password)) { //checking old_password and current_user password same or not
            $user = User::findOrFail(Auth::id()); //current user data get
            $user->password = Hash::make($request->password); //current user password hasing
            $user->save(); //finally save the password
            Auth::logout(); //logout the admin user and redirect admin login panel not user login panel

            $notification = array('messege' => 'Your Password Changed!', 'alert-type' => 'success');
            return redirect()->route('admin.login')->with($notification);
        } else {
            $notification = array('messege' => 'Old Password Not Matched!', 'alert-type' => 'error');
            return redirect()->back()->with($notification);
        }
    }
}
