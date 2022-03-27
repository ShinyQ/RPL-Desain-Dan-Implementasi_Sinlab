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

    public function index(){
        $title = "Daftar Pengguna";
        $users = User::latest()->paginate();

        return view('user.index', compact('users', 'title'));
    }
    public function profile(){
        $title = "Profile";
        $user = User::findOrFail(request()->session()->get('user')->id);

        return view('user.profile', compact('user', 'title'));
    }

    public function update_role($id, $role){
        $user = User::where('id', $id)->update(['role'=> $role]);

        if($user){
            session()->flash('success', 'Sukses Mengupdate Role User');
        } else {
            session()->flash('failed', 'Gagal Mengupdate Role User');
        }

        Return redirect()->back();
    }

    public function logout(){
        request()->session()->forget('user');
        return redirect('user/login')->with('success', 'Sukses Melakukan Logout');
    }
}
