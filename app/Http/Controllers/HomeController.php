<?php

namespace App\Http\Controllers;

use App\Models\Judge;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Http\Controllers\RegisteredUserController;

class HomeController extends Controller
{
    //
    public function index(){
        $judges = User::where('usertype', 'judge')->get();
        if (Auth::user()->usertype == 'camis') {
            return view('appealEase.camisUser.dashboard');
            // return view('appealEase.user.main', compact('judges'));
        } else if (Auth::user()->usertype == 'clerk') {
            return view('appealEase.clerkUser.main');
        } else if (Auth::user()->usertype == 'judge') {
            return view('appealEase.divisionUser.dashboard');
        } else {
            return view('appealEase.systemAdmin.dashboard.main', compact('judges'));
        }
    }
}
