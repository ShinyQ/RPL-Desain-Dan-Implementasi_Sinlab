<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    public function index(){
        if(auth()->user()->role != 'super_user'){
            return redirect('/item');
        }

        $title = "Halaman Dashboard";
        return view('index', compact('title'));
    }
}
