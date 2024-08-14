<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    //
    public function index(){
        if (Auth::user()->usertype == 'camis') {
            return view('appealEase.camisUser.dashboard');
            // return view('appealEase.user.main', compact('judges'));
        } else if (Auth::user()->usertype == 'clerk') {
            return view('appealEase.clerkUser.dashboard');
        } else if (Auth::user()->usertype == 'judge') {
            return view('appealEase.divisionUser.dashboard');
        } else {
            return view('appealEase.systemAdmin.dashboard.main');
        }
    }
}
