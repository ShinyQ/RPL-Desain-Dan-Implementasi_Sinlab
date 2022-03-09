<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    public function view_login(){
        if (session()->get('user')){
            return redirect()->back();
        }

        return view('login');
    }

    public function profile(){
        $user = User::findOrFail(request()->session()->get('user')->id);
        return view('profile', compact('user'));
    }

    public function logout(){
        request()->session()->forget('user');
        return redirect('user/login')->with('success', 'Sukses Melakukan Logout');
    }
}
