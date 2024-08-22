<?php

namespace App\Http\Controllers;

use App\Models\CaseModel;
use App\Models\Requirement;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LinkController extends Controller
{
    //CAMIS
    public function nav1()
    {
        if (Auth::user()->usertype == 'camis') {
            $civilRequirements = Requirement::where('case_type', 'civil')->get();
            $criminalRequirements = Requirement::where('case_type', 'criminal')->get();
            $specialRequirements = Requirement::where('case_type', 'special')->get();
            $cases = CaseModel::all();
            return view('appealEase.camisUser.dashboard.main', compact('civilRequirements', 'criminalRequirements', 'specialRequirements', 'cases'));
            // return view('appealEase.user.main', compact('judges'));
        } else if (Auth::user()->usertype == 'clerk') {
            $status = CaseModel::where('status', 'sent')->get();
            return view('appealEase.clerkUser.dashboard.main', compact('status'));
        } else if (Auth::user()->usertype == 'judge') {
            $userId = Auth::id();
            $cases = CaseModel::where('case_judgeID', $userId)->get();
            return view('appealEase.judgeUser.dashboard.main', compact('cases'));
        } else {
            $judges = User::where('usertype', 'judge')->get();
            return view('appealEase.systemAdmin.dashboard.main', compact('judges'));
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
        }
    }

    public function nav3()
    {
        if (Auth::user()->usertype == 'camis') {
            $cases = CaseModel::where('approvalStatus', 'denied')->get();
            return view('appealEase.camisUser.deniedCases.main', compact('cases'));
        } else if (Auth::user()->usertype == 'admin') {
            return view('appealEase.systemAdmin.admin-management.main');
        }
    }
}
