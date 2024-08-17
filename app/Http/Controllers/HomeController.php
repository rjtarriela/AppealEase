<?php

namespace App\Http\Controllers;

use App\Models\CaseModel;
use App\Models\Judge;
use App\Models\Requirement;
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

        $civilRequirements = Requirement::where('case_type', 'civil')->get();
        $criminalRequirements = Requirement::where('case_type', 'criminal')->get();
        $specialRequirements = Requirement::where('case_type', 'special')->get();
        $cases = CaseModel::all();

        $status = CaseModel::where('status', 'sent')->get();

        if (Auth::user()->usertype == 'camis') {
            return view('appealEase.camisUser.dashboard.main', compact('civilRequirements', 'criminalRequirements', 'specialRequirements', 'cases'));
            // return view('appealEase.user.main', compact('judges'));
        } else if (Auth::user()->usertype == 'clerk') {
            return view('appealEase.clerkUser.dashboard.main', compact('status'));
        } else if (Auth::user()->usertype == 'judge') {
            return view('appealEase.divisionUser.dashboard');
        } else {
            return view('appealEase.systemAdmin.dashboard.main', compact('judges'));
        }
    }
}
