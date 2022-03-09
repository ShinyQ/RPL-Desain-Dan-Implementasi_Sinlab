<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function view_login(){
        return view('login');
    }

    public function profile(Request $request){
        $user = User::findOrFail($request->session()->get('user')->id);
        return view('profile', compact('user'));
    }

    public function logout(Request $request){
        $request->session()->forget('user');
        return redirect('/login')->with('success', 'Sukses Melakukan Logout');
    }
}
