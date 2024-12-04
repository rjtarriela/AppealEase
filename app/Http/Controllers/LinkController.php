<?php

namespace App\Http\Controllers;

use App\Models\CaseModel;
use App\Models\CasesSolved;
use App\Models\Requirement;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LinkController extends Controller
{
    // REMOVE DIVISION SIDE SOON IN NAV1
    public function nav1()
    {
        if (Auth::user()->usertype == 'camis') {
            // CAMIS Dashboard
            $civilRequirements = Requirement::where('case_type', 'civil')->get();
            $criminalRequirements = Requirement::where('case_type', 'criminal')->get();
            $specialRequirements = Requirement::where('case_type', 'special')->get();

            // hanggat di pa na sesent, nakadisplay lang yung mga cases.
            $cases = CaseModel::where('status', 'pending')->get();

            $user = Auth::user();

            return view('appealEase.camisUser.dashboard.main', compact('civilRequirements', 'criminalRequirements', 'specialRequirements', 'cases', 'user'));
        } else if (Auth::user()->usertype == 'clerk') {
            // CLERK Dashboard
            $status = CaseModel::where('statusRandom', 'unassigned')->get();

            return view('appealEase.clerkUser.dashboard.main', compact('status'));
        } else if (Auth::user()->usertype == 'judge') {
            // JUDGE Dashboard
            $user = Auth::user();
            $caseDivision = Auth::user()->division;
            $cases = CaseModel::where('division', $caseDivision)
                ->whereNotIn('adminStatus', ['Completed', 'Sent to Supreme Court'])
                ->get();
            $judges = User::where('division', $caseDivision)->where('usertype', 'judge')->get();

            return view('appealEase.judgeUser.dashboard.main', compact('cases', 'user', 'judges'));
        } else if (Auth::user()->usertype == 'division') {
            // DIVISION Dashboard
            $divisionID = Auth::user()->division;
            $judges = User::where('usertype', 'judge')->where('division', $divisionID)->get();

            return view('appealEase.divisionAdmin.dashboard.main', compact('judges'));
        } else {
            // ADMIN Dashboard
            // Get all distinct divisions from the users table
            $divisions = User::whereNotNull('division')->distinct()->pluck('division');

            // Prepare an array to hold the division data with solved cases
            $divisionData = [];

            foreach ($divisions as $divisionId) {
                // Find the corresponding entry in the cases_solved table
                $caseSolved = CasesSolved::where('division_id', $divisionId)->first();

                $justices = User::where('division', $divisionId)
                    ->where('usertype', 'judge')
                    ->whereIn('judgeRole', ['head', 'normal'])
                    ->get();

                $divisionData[] = [
                    'division_id' => $divisionId,
                    'criminal_cases_solved' => $caseSolved->criminal_cases_solved ?? 0,
                    'civil_cases_solved' => $caseSolved->civil_cases_solved ?? 0,
                    'special_cases_solved' => $caseSolved->special_cases_solved ?? 0,
                ];
            }

            return view('appealEase.systemAdmin.dashboard.main', compact('divisionData'));
        }
    }

    public function nav2()
    {
        if (Auth::user()->usertype == 'camis') {
            $cases = CaseModel::where('adminStatus', 'Completed')->get();
            return view('appealEase.camisUser.approvedCases.main', compact('cases'));
        } else if (Auth::user()->usertype == 'admin') {
            // $civilRequirements = Requirement::where('case_type', 'civil')->get();
            // $criminalRequirements = Requirement::where('case_type', 'criminal')->get();
            // $specialRequirements = Requirement::where('case_type', 'special')->get();

            // return view('appealEase.systemAdmin.requirement-details.main', compact('civilRequirements', 'criminalRequirements', 'specialRequirements'));
            return view('appealEase.systemAdmin.admin-management.main');
        } else if (Auth::user()->usertype == 'judge') {
            $caseDivision = Auth::user()->division;
            $judges = User::where('division', $caseDivision)->where('usertype', 'judge')->get();

            return view('appealEase.judgeUser.judgeProfile.main', compact('judges'));
        }
    }

    public function nav3()
    {
        // if (Auth::user()->usertype == 'camis') {
        //     // $civilRequirements = Requirement::where('case_type', 'civil')->get();
        //     // $criminalRequirements = Requirement::where('case_type', 'criminal')->get();
        //     // $specialRequirements = Requirement::where('case_type', 'special')->get();
        //     // $cases = CaseModel::where('approvalStatus', 'denied')->get();
        //     // return view('appealEase.camisUser.deniedCases.main', compact('cases', 'civilRequirements', 'criminalRequirements', 'specialRequirements'));

        //     $litigants = User::where('usertype', 'litigant')->get();

        //     return view('appealEase.systemAdmin.litigant-profile.main', compact('litigants'));
        // } else 
        if (Auth::user()->usertype == 'admin') {
            $litigants = User::where('usertype', 'camis')->get();

            return view('appealEase.systemAdmin.litigant-profile.main', compact('litigants'));
        }
    }
}
