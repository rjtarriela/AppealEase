<?php

namespace App\Http\Controllers;

use App\Models\CaseModel;
use App\Models\Requirement;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LinkController extends Controller
{
    public function nav1()
    {
        if (Auth::user()->usertype == 'camis') {
            // CAMIS Dashboard
            $civilRequirements = Requirement::where('case_type', 'civil')->get();
            $criminalRequirements = Requirement::where('case_type', 'criminal')->get();
            $specialRequirements = Requirement::where('case_type', 'special')->get();
            $cases = CaseModel::all();

            // hanggat di pa na sesent, nakadisplay lang yung mga cases.
            // $cases = CaseModel::where('status', 'pending')->get();
            return view('appealEase.camisUser.dashboard.main', compact('civilRequirements', 'criminalRequirements', 'specialRequirements', 'cases'));
        } else if (Auth::user()->usertype == 'clerk') {
            // CLERK Dashboard
            $status = CaseModel::where('statusRandom', 'unassigned')->get();
            return view('appealEase.clerkUser.dashboard.main', compact('status'));
        } else if (Auth::user()->usertype == 'judge') {
            // JUDGE Dashboard
            // $userId = Auth::id();
            $user = Auth::user();
            $caseDivision = Auth::user()->division;
            $cases = CaseModel::where('division', $caseDivision)->get();
            $judges = User::where('division', $caseDivision)->where('usertype', 'judge')->get();

            return view('appealEase.judgeUser.dashboard.main', compact('cases', 'user', 'judges'));
        } else if (Auth::user()->usertype == 'division') {
            // DIVISION Dashboard
            $divisionID = Auth::user()->division;
            $judges = User::where('usertype', 'judge')->where('division', $divisionID)->get();
            return view('appealEase.divisionAdmin.dashboard.main', compact('judges'));
        } else {
            // ADMIN Dashboard
            $judges = User::where('usertype', 'judge')->get();
            $cases = CaseModel::all();
            return view('appealEase.systemAdmin.dashboard.main', compact('judges', 'cases'));
        }
    }

    public function nav2()
    {
        if (Auth::user()->usertype == 'camis') {
            $cases = CaseModel::where('approvalStatus', 'approved')->get();
            return view('appealEase.camisUser.approvedCases.main', compact('cases'));
        } else if (Auth::user()->usertype == 'admin') {
            $civilRequirements = Requirement::where('case_type', 'civil')->get();
            $criminalRequirements = Requirement::where('case_type', 'criminal')->get();
            $specialRequirements = Requirement::where('case_type', 'special')->get();

            return view('appealEase.systemAdmin.requirement-details.main', compact('civilRequirements', 'criminalRequirements', 'specialRequirements'));
        } else if (Auth::user()->usertype == 'judge') {
            $caseDivision = Auth::user()->division;
            $judges = User::where('division', $caseDivision)->where('usertype', 'judge')->get();

            return view('appealEase.judgeUser.judgeProfile.main', compact('judges'));
        }
    }

    public function nav3()
    {
        if (Auth::user()->usertype == 'camis') {
            $civilRequirements = Requirement::where('case_type', 'civil')->get();
            $criminalRequirements = Requirement::where('case_type', 'criminal')->get();
            $specialRequirements = Requirement::where('case_type', 'special')->get();
            $cases = CaseModel::where('approvalStatus', 'denied')->get();
            return view('appealEase.camisUser.deniedCases.main', compact('cases', 'civilRequirements', 'criminalRequirements', 'specialRequirements'));
        } else if (Auth::user()->usertype == 'admin') {
            return view('appealEase.systemAdmin.admin-management.main');
        }
    }
}
