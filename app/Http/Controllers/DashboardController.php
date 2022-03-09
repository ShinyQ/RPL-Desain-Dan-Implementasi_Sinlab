<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    public function index(){
        $title = "Halaman Dashboard";
        return view('index', compact('title'));
    }
}
