<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(){
        if(auth()->user()->role != 'super_user'){
            return redirect('/item');
        }

        $title = "Halaman Dashboard";
        $deadline = Transaction::where('status', 'Diterima')
            ->whereBetween('deadline', [Carbon::now(), Carbon::now()->addDays(5)])
            ->oldest()
            ->get();

        return view('index', compact('title', 'deadline'));
    }
}
